const { readFileSync } = require('fs');
const { WebSocketServer, WebSocket } = require('ws');

const PHP_CONFIG = readFileSync(__dirname + '/config.php', 'utf8');
const m = PHP_CONFIG.match(/define\('GEMINI_API_KEY',\s*'([^']+)'\)/);
const KEY = m ? m[1] : '';
if (!KEY) { console.error('No API key'); process.exit(1); }

const WS_URL = 'wss://generativelanguage.googleapis.com/ws/google.ai.generativelanguage.v1alpha.GenerativeService.BidiGenerateContent?key=' + KEY;
const PORT = 3001;

const srv = new WebSocketServer({ port: PORT });
console.log('Gemini Live proxy on ws://localhost:' + PORT);

srv.on('connection', (bw) => {
    console.log('[+] Browser');
    const gw = new WebSocket(WS_URL);
    let geminiReady = false;
    let setupSent = false;
    let pending = [];

    gw.on('open', () => {
        console.log('[+] Gemini connected');
        geminiReady = true;
        // Flush pending
        while (pending.length) {
            gw.send(pending.shift());
        }
    });
    gw.on('close', (c) => { console.log('[-] Gemini', c); if (bw.readyState === bw.OPEN) bw.close(); });
    gw.on('error', (e) => { console.error('[Gemini err]', e.message); if (bw.readyState === bw.OPEN) bw.send(JSON.stringify({error: e.message})); });
    gw.on('message', (d) => {
        if (bw.readyState === bw.OPEN) bw.send(d);
        const prev = typeof d === 'string' ? d.substring(0, 80).replace(/\n/g, ' ') : '<audio ' + d.length + 'B>';
        console.log('  ←', prev);
    });

    bw.on('message', (d) => {
        const str = typeof d === 'string' ? d : d.toString();
        if (!setupSent) {
            try {
                const j = JSON.parse(str);
                if (j.setup && j.setup.model) {
                    console.log('  Model:', j.setup.model);
                }
            } catch(e) {}
            setupSent = true;
        }
        if (geminiReady) {
            gw.send(d);
        } else {
            pending.push(d);
        }
        const prev = typeof d === 'string' ? d.substring(0, 60).replace(/\n/g, '') : '<audio ' + d.length + 'B>';
        console.log('  →', prev);
    });
    bw.on('close', () => { console.log('[-] Browser'); if (gw.readyState === gw.OPEN) gw.close(); });
    bw.on('error', () => {});
});
