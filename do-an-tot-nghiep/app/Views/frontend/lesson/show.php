<style>
.lesson-page{max-width:960px;margin:auto;padding:24px}
.lesson-hero{background:linear-gradient(135deg,#0f766e,#134e4a);border-radius:24px;padding:32px;color:#fff;position:relative;overflow:hidden}
.lesson-hero.hsk3-4{background:linear-gradient(135deg,#1e40af,#1e3a5f)}
.lesson-hero.hsk5-6{background:linear-gradient(135deg,#7c3aed,#5b21b6)}
.lesson-hero .badge{display:inline-block;padding:4px 12px;border-radius:99px;font-size:.75rem;font-weight:700;background:rgba(255,255,255,.2);margin-bottom:8px}
.lesson-hero h1{margin:8px 0;font-size:2rem}
.lesson-hero p{margin:0;opacity:.9;line-height:1.6}
.lesson-meta{display:flex;gap:16px;flex-wrap:wrap;margin-top:12px;font-size:.85rem;opacity:.8}
.lesson-meta span{display:flex;align-items:center;gap:4px}
.progress-bar-small{height:4px;background:rgba(255,255,255,.3);border-radius:99px;margin-top:12px;overflow:hidden}
.progress-bar-small .fill{height:100%;background:#fff;border-radius:99px;transition:width .5s}
.section-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:24px;margin:16px 0;box-shadow:0 1px 3px rgba(0,0,0,.04)}
.section-card h2{margin:0 0 16px;color:#102a56;font-size:1.2rem;display:flex;align-items:center;gap:8px}
.section-card h2 .count{font-size:.75rem;color:#64748b;font-weight:400}
.objectives-list{list-style:none;padding:0;display:grid;grid-template-columns:1fr 1fr;gap:8px}
.objectives-list li{padding:8px 12px;border-radius:8px;background:#f0fdfa;color:#065f46;font-size:.85rem;display:flex;align-items:center;gap:8px}
.objectives-list li::before{content:"\2713";font-weight:700;color:#10b981}
.vocab-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:10px}
.vocab-card{padding:14px;border:1px solid #e2e8f0;border-radius:12px;transition:.15s}
.vocab-card:hover{box-shadow:0 2px 12px rgba(0,0,0,.06)}
.vocab-card .top{display:flex;align-items:center;justify-content:space-between}
.vocab-card .hanzi{font-size:1.4rem;font-weight:700;cursor:pointer;color:#102a56}
.vocab-card .hanzi:hover{color:var(--teal)}
.vocab-card .pinyin{color:var(--teal);font-weight:600;font-size:.9rem;margin-top:2px}
.vocab-card .meaning{color:#475569;font-size:.85rem;margin-top:2px}
.vocab-card .badges{display:flex;gap:4px;flex-wrap:wrap;margin-top:6px}
.vocab-card .badge{font-size:.7rem;padding:2px 8px;border-radius:99px;background:#f1f5f9;color:#475569}
.vocab-card .example{margin-top:8px;padding:8px;background:#f8fafc;border-radius:8px;font-size:.82rem;color:#334155;line-height:1.5;border-left:3px solid var(--teal)}
.vocab-card .example-vi{font-size:.78rem;color:#94a3b8;margin-top:4px}
.vocab-card .actions{display:flex;gap:6px;margin-top:8px}
.vocab-card .actions button{border:0;cursor:pointer;padding:4px 10px;border-radius:6px;font-size:.75rem;transition:.15s}
.btn-play-sm{background:#ecfdf5;color:#047857}
.btn-fav{background:#fef2f2;color:#e11d48}
.btn-done{background:#dbeafe;color:#1d4ed8}
.grammar-card{border:1px solid #e2e8f0;border-radius:12px;margin-bottom:12px;overflow:hidden}
.grammar-card .header{padding:12px 16px;background:#f0fdfa;border-bottom:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center}
.grammar-card .header h3{margin:0;font-size:.95rem;color:#065f46}
.grammar-card .formula{font-size:.8rem;color:#64748b;font-family:monospace}
.grammar-card .body{padding:12px 16px}
.grammar-card .body .label{font-size:.75rem;color:#94a3b8;text-transform:uppercase;font-weight:600;margin-top:8px}
.grammar-card .body .label:first-child{margin-top:0}
.grammar-card .body p{margin:4px 0;font-size:.85rem;color:#475569;line-height:1.6}
.grammar-card .examples{margin-top:8px}
.grammar-card .examples table{width:100%;font-size:.82rem;border-collapse:collapse}
.grammar-card .examples td{padding:4px 8px;border-bottom:1px solid #f1f5f9}
.grammar-card .examples td:first-child{font-weight:600;color:#102a56}
.dialogue-box{padding:16px;background:#f8fafc;border-radius:12px;margin-bottom:12px}
.dialogue-context{font-size:.85rem;color:#64748b;margin-bottom:12px;font-style:italic}
.dialogue-line{display:flex;gap:10px;margin:8px 0;align-items:flex-start}
.dialogue-avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;color:#fff;flex-shrink:0}
.dialogue-avatar.A{background:#0f766e}
.dialogue-avatar.B{background:#1d4ed8}
.dialogue-avatar.C{background:#b45309}
.dialogue-avatar.D{background:#7c3aed}
.dialogue-content{flex:1}
.dialogue-content .cn{font-size:.9rem;line-height:1.5}
.dialogue-content .pinyin{font-size:.75rem;color:#94a3b8;margin-top:2px}
.dialogue-content .vi{font-size:.8rem;color:#64748b;margin-top:2px;display:none}
.dialogue-content.show-vi .vi{display:block}
.reading-box{padding:20px;background:#f8fafc;border-radius:12px;line-height:2;font-size:1rem;margin-bottom:12px}
.reading-box .pinyin-text{display:none;color:#94a3b8;font-size:.85rem;line-height:1.8}
.reading-box .vi-text{display:none;color:#64748b;font-size:.85rem;line-height:1.6;margin-top:8px;padding-top:8px;border-top:1px solid #e2e8f0}
.listening-card{padding:20px;background:linear-gradient(135deg,#f0fdfa,#ecfdf5);border-radius:12px}
.listening-transcript{display:none;margin-top:12px;padding:12px;background:#fff;border-radius:8px;font-size:.85rem;line-height:1.6}
.speaking-card{text-align:center;padding:24px}
.speaking-target{font-size:2rem;font-weight:700;color:#102a56;margin:16px 0}
.speaking-pinyin{color:var(--teal);font-size:.9rem}
.mic-btn{width:64px;height:64px;border-radius:50%;border:0;background:var(--teal);color:#fff;font-size:24px;cursor:pointer;transition:.15s;margin:16px auto}
.mic-btn:hover{transform:scale(1.1)}
.mic-btn.recording{background:#ef4444;animation:pulse 1s infinite}
@keyframes pulse{0%{box-shadow:0 0 0 0 rgba(239,68,68,.4)}50%{box-shadow:0 0 0 12px rgba(239,68,68,0)}100%{box-shadow:0 0 0 0 rgba(239,68,68,0)}}
.writing-card{text-align:center}
.writing-char{font-size:5rem;color:#102a56;margin:16px 0;line-height:1}
.stroke-number{font-size:.85rem;color:#64748b;margin-bottom:8px}
.stroke-canvas{border:1px solid #e2e8f0;border-radius:8px;margin:8px auto;display:block}
.stroke-btn{padding:8px 16px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;font-size:.8rem;margin:4px}
.flashcard-mini{perspective:800px;height:180px;margin:12px 0}
.flashcard-inner{position:relative;width:100%;height:100%;transition:transform .4s;transform-style:preserve-3d;cursor:pointer}
.flashcard-inner.flipped{transform:rotateY(180deg)}
.flashcard-face{position:absolute;width:100%;height:100%;backface-visibility:hidden;border-radius:12px;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:20px;box-sizing:border-box}
.flashcard-front{background:linear-gradient(135deg,#0f766e,#134e4a);color:#fff}
.flashcard-front .fc-hanzi{font-size:3rem;font-weight:700}
.flashcard-back{background:#fff;border:1px solid #e2e8f0;transform:rotateY(180deg)}
.flashcard-back .fc-pinyin{font-size:1.3rem;color:var(--teal)}
.flashcard-back .fc-meaning{font-size:1rem;color:#475569;margin-top:4px}
.exercise-item{padding:16px;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:10px}
.exercise-item .q{font-weight:600;margin-bottom:10px;font-size:.9rem}
.exercise-options{display:flex;flex-direction:column;gap:6px}
.matching-grid{display:flex;gap:24px;justify-content:center;margin:8px 0}.matching-col{display:flex;flex-direction:column;gap:6px;min-width:140px}.matching-item{padding:8px 14px;border:1px solid #e2e8f0;border-radius:8px;cursor:pointer;transition:.2s;font-size:.9rem;text-align:center;background:#fff}.matching-item.selected{border-color:var(--teal);background:var(--teal-light);font-weight:600}.matching-item.correct{border-color:#059669;background:#d1fae5;color:#065f46}.matching-item.wrong{border-color:#dc2626;background:#fef2f2;color:#991b1b}.wrong-sentence{padding:10px 14px;background:#fef2f2;border-left:3px solid #dc2626;border-radius:0 8px 8px 0;margin:8px 0;font-size:.95rem}.grammar-correction textarea,.reading-qa textarea{width:100%;box-sizing:border-box;resize:vertical}
.exercise-option{display:flex;align-items:center;gap:10px;padding:8px 12px;border:1px solid #e2e8f0;border-radius:8px;cursor:pointer;transition:.15s;font-size:.85rem}
.exercise-option:hover{border-color:var(--teal);background:#f0fdfa}
.exercise-option.selected{border-color:var(--teal);background:#ecfdf5}
.exercise-option.correct{border-color:#10b981;background:#ecfdf5!important}
.exercise-option.wrong{border-color:#ef4444;background:#fef2f2!important}
.exercise-fill-input{width:100%;padding:8px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:.9rem;box-sizing:border-box;font-family:inherit}
.exercise-fill-input.correct{border-color:#10b981;background:#ecfdf5}
.exercise-fill-input.wrong{border-color:#ef4444;background:#fef2f2}
.order-chips{display:flex;flex-wrap:wrap;gap:6px;min-height:36px;padding:8px;border:1px solid #e2e8f0;border-radius:8px;margin:8px 0}
.order-chip{padding:6px 14px;border-radius:6px;background:#dbeafe;color:#1d4ed8;cursor:pointer;font-size:.85rem;transition:.15s}
.order-chip:hover{background:#bfdbfe}
.order-chip.selected{opacity:.5;text-decoration:line-through}
.summary-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.summary-card{padding:14px;border-radius:10px;font-size:.85rem;text-align:center}
.summary-card.green{background:#ecfdf5;color:#047857}
.summary-card.blue{background:#dbeafe;color:#1d4ed8}
.summary-card.yellow{background:#fef3c7;color:#b45309}
.summary-card.purple{background:#f3e8ff;color:#7c3aed}
.summary-card .number{font-size:1.5rem;font-weight:700}
.lesson-nav{display:flex;justify-content:space-between;gap:12px;margin-top:24px}
.lesson-nav a{flex:1;text-align:center;padding:14px;border-radius:12px;font-weight:700;text-decoration:none;transition:.15s}
.lesson-nav .prev{background:#f1f5f9;color:#475569}
.lesson-nav .next{background:var(--teal);color:#fff}
.lesson-nav .next:hover{background:#0d9488}
.lesson-tabs{display:flex;gap:0;margin:16px 0;border-radius:10px;overflow:hidden;border:1px solid #e2e8f0;flex-wrap:wrap}
.lesson-tab{padding:8px 16px;font-size:.8rem;font-weight:600;cursor:pointer;transition:.15s;background:#fff;color:#475569;border:0;border-right:1px solid #e2e8f0}
.lesson-tab:last-child{border-right:0}
.lesson-tab:hover{background:#f8fafc}
.lesson-tab.active{background:var(--teal);color:#fff}
.toggle-btn{padding:6px 14px;border:1px solid #e2e8f0;border-radius:8px;background:#fff;cursor:pointer;font-size:.8rem;transition:.15s;margin:4px}
.toggle-btn:hover{border-color:var(--teal);color:var(--teal)}
.toggle-btn.active{background:var(--teal);color:#fff;border-color:var(--teal)}
</style>

<main class="lesson-page">

<!-- SECTION 1: BANNER -->
<div class="lesson-hero hsk<?=$lesson['level']<=2?'':($lesson['level']<=4?'3-4':'5-6')?>">
  <div class="badge">HSK <?=$lesson['level']?> &middot; B&agrave;i <?=$lesson['lesson_num']?></div>
  <h1><?=escape($lesson['title'])?></h1>
  <p><?=escape($lesson['description'])?></p>
  <div class="lesson-meta">
    <span>&#9201; <?=($lesson['duration_minutes'] ?? (15 + $lesson['level']*5))?> ph&uacute;t</span>
    <span>&#128218; <?=count($vocab)?> t&#7915; v&#7921;ng</span>
    <span>&#128221; <?=count($grammarList)?> ng&#7919; ph&aacute;p</span>
    <span>&#128290; C&#7845;p &#273;&#7897; <?=$lesson['level']?>/6</span>
  </div>
  <?php if($progress): ?>
  <div class="progress-bar-small"><div class="fill" style="width:<?=($progress['is_completed']?100:($progress['exercise_score']??0))?>%"></div></div>
  <?php endif; ?>
</div>

<!-- TABS NAVIGATION -->
<div class="lesson-tabs">
  <button class="lesson-tab active" onclick="scrollToSection('objectives')">M&#7909;c ti&ecirc;u</button>
  <button class="lesson-tab" onclick="scrollToSection('vocab-section')">T&#7915; v&#7921;ng</button>
  <button class="lesson-tab" onclick="scrollToSection('grammar-section')">Ng&#7919; ph&aacute;p</button>
  <button class="lesson-tab" onclick="scrollToSection('dialogue-section')">H&#7897;i tho&#7841;i</button>
  <button class="lesson-tab" onclick="scrollToSection('reading-section')">&#272;&#7885;c</button>
  <button class="lesson-tab" onclick="scrollToSection('listening-section')">Nghe</button>
  <button class="lesson-tab" onclick="scrollToSection('speaking-section')">N&oacute;i</button>
  <button class="lesson-tab" onclick="scrollToSection('writing-section')">Vi&#7871;t</button>
  <button class="lesson-tab" onclick="scrollToSection('flashcard-section')">Flashcard</button>
  <button class="lesson-tab" onclick="scrollToSection('exercise-section')">B&agrave;i t&#7853;p</button>
  <button class="lesson-tab" onclick="scrollToSection('summary-section')">T&#7893;ng k&#7871;t</button>
</div>

<!-- SECTION 2: OBJECTIVES -->
<div class="section-card" id="objectives">
  <h2>&#127919; M&#7909;c ti&ecirc;u b&agrave;i h&#7885;c</h2>
  <ul class="objectives-list">
    <li>H&#7885;c <?=count($vocab)?> t&#7915; v&#7921;ng m&#7899;i</li>
    <li>N&#7855;m v&#7919;ng <?=count($grammarList)?> &#273;i&#7875;m ng&#7919; ph&aacute;p</li>
    <?php if(count($dialogues)>0): ?><li>Luy&#7879;n <?=count($dialogues)?> &#273;o&#7841;n h&#7897;i tho&#7841;i</li><?php endif; ?>
    <?php if($reading): ?><li>&#272;&#7885;c hi&#7875;u &#273;o&#7841;n v&#259;n &ldquo;<?=escape($reading['title'])?>&rdquo;</li><?php endif; ?>
    <?php if($listening): ?><li>Luy&#7879;n nghe hi&#7875;u</li><?php endif; ?>
    <?php if(count($speaking)>0): ?><li>Luy&#7879;n ph&aacute;t &acirc;m</li><?php endif; ?>
    <?php if(count($writing)>0): ?><li>T&#7853;p vi&#7871;t ch&#7915; H&aacute;n</li><?php endif; ?>
    <li>Ho&agrave;n th&agrave;nh b&agrave;i t&#7853;p &ocirc;n luy&#7879;n</li>
  </ul>
</div>

<!-- SECTION 3: VOCABULARY -->
<div class="section-card" id="vocab-section">
  <h2>&#128214; T&#7915; v&#7921;ng <span class="count"><?=count($vocab)?> t&#7915;</span></h2>
  <?php if(count($vocab)===0): ?><p style="color:#94a3b8;font-size:.85rem">Ch&#432;a c&oacute; d&#7919; li&#7879;u t&#7915; v&#7921;ng cho b&agrave;i n&agrave;y.</p><?php endif; ?>
  <div class="vocab-grid">
    <?php foreach($vocab as $v): ?>
    <div class="vocab-card" id="vocab-<?=$v['id']?>">
      <div class="top">
        <span class="hanzi" onclick="speak('<?=escape($v['hanzi'])?>')"><?=escape($v['hanzi'])?></span>
        <button class="btn-play-sm" onclick="speak('<?=escape($v['hanzi'])?>')">&#9654; Nghe</button>
      </div>
      <div class="pinyin"><?=escape($v['pinyin'])?></div>
      <div class="meaning"><?=escape($v['meaning'])?></div>
      <div class="badges">
        <?php if($v['radical']): ?><span class="badge">B&#7897; <?=escape($v['radical'])?></span><?php endif; ?>
        <?php if($v['strokes']): ?><span class="badge"><?=$v['strokes']?> n&eacute;t</span><?php endif; ?>
      </div>
      <?php if($v['example']): ?>
      <div class="example"><?=escape($v['example'])?></div>
      <?php endif; ?>
      <?php if($v['example_vi']): ?>
      <div class="example-vi"><?=escape($v['example_vi'])?></div>
      <?php endif; ?>
      <div class="actions">
        <button class="btn-fav" onclick="toggleFav(<?=$v['id']?>,this)">&#10084; Y&ecirc;u th&iacute;ch</button>
        <button class="btn-done" onclick="markLearned(<?=$v['id']?>,this)">&#10003; &#272;&atilde; h&#7885;c</button>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- SECTION 4: GRAMMAR -->
<div class="section-card" id="grammar-section">
  <h2>&#128218; Ng&#7919; ph&aacute;p <span class="count"><?=count($grammarList)?> &#273;i&#7875;m</span></h2>
  <?php if(count($grammarList)===0): ?><p style="color:#94a3b8;font-size:.85rem">Ch&#432;a c&oacute; d&#7919; li&#7879;u ng&#7919; ph&aacute;p cho b&agrave;i n&agrave;y.</p><?php endif; ?>
  <?php
    $seen = [];
    $grouped = [];
    foreach ($grammarList as $g) {
        $gid = $g['id'];
        if (!isset($seen[$gid])) {
            $seen[$gid] = [
                'id' => $gid,
                'title' => $g['title'],
                'formula' => $g['formula'] ?? '',
                'meaning' => $g['meaning'] ?? '',
                'usage' => $g['usage'] ?? '',
                'notes' => $g['notes'] ?? '',
                'examples' => []
            ];
        }
        if ($g['example_cn']) {
            $seen[$gid]['examples'][] = [
                'cn' => $g['example_cn'],
                'pinyin' => $g['example_pinyin'] ?? '',
                'vi' => $g['example_vi'] ?? ''
            ];
        }
    }
  ?>
  <?php foreach ($seen as $g): ?>
  <div class="grammar-card">
    <div class="header">
      <h3><?=escape($g['title'])?></h3>
      <span class="formula"><?=escape($g['formula'])?></span>
    </div>
    <div class="body">
      <div class="label">&Yacute; ngh&#296;a</div>
      <p><?=escape($g['meaning'])?></p>
      <div class="label">C&aacute;ch d&ugrave;ng</div>
      <p><?=escape($g['usage'])?></p>
      <?php if($g['notes']): ?>
      <div class="label">L&#432;u &yacute;</div>
      <p style="color:#b45309"><?=escape($g['notes'])?></p>
      <?php endif; ?>
      <?php if(count($g['examples'])>0): ?>
      <div class="label">V&iacute; d&#7909;</div>
      <div class="examples">
        <table>
          <?php foreach($g['examples'] as $ex): ?>
          <tr>
            <td><?=escape($ex['cn'])?></td>
            <td style="color:var(--teal);font-size:.8rem"><?=escape($ex['pinyin'])?></td>
            <td style="color:#64748b;font-size:.8rem"><?=escape($ex['vi'])?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<!-- SECTION 5: DIALOGUES -->
<div class="section-card" id="dialogue-section">
  <h2>&#128172; H&#7897;i tho&#7841;i <span class="count"><?=count($dialogues)?> &#273;o&#7841;n</span></h2>
  <?php if(count($dialogues)===0): ?><p style="color:#94a3b8;font-size:.85rem">Ch&#432;a c&oacute; d&#7919; li&#7879;u h&#7897;i tho&#7841;i cho b&agrave;i n&agrave;y.</p><?php endif; ?>
  <button class="toggle-btn" onclick="toggleAllVi()" id="toggleViBtn">Hi&#7879;n b&#7843;n d&#7883;ch</button>
  <?php foreach($dialogues as $d): ?>
  <div class="dialogue-box">
    <?php if(!empty($d['title'])): ?><div style="font-weight:600;margin-bottom:4px"><?=escape($d['title'])?></div><?php endif; ?>
    <?php if(!empty($d['context'])): ?><div class="dialogue-context"><?=escape($d['context'])?></div><?php endif; ?>
    <button class="toggle-btn" onclick="playDialogue()">&#9654; Ph&aacute;t t&#7845;t c&#7843;</button>
    <?php foreach($d['sentences'] as $s): ?>
    <div class="dialogue-line">
      <div class="dialogue-avatar <?=escape($s['speaker'])?>"><?=mb_substr(escape($s['speaker']),0,1)?></div>
      <div class="dialogue-content">
        <div class="cn"><?=escape($s['chinese'])?> <button class="toggle-btn" style="padding:2px 6px;font-size:.7rem" onclick="speak('<?=escape($s['chinese'])?>')">&#9654;</button></div>
        <div class="pinyin"><?=escape($s['pinyin'] ?? '')?></div>
        <div class="vi"><?=escape($s['vietnamese'] ?? '')?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endforeach; ?>
</div>

<!-- SECTION 6: READING -->
<?php if($reading): ?>
<div class="section-card" id="reading-section">
  <h2>&#128214; B&agrave;i &#273;&#7885;c: <?=escape($reading['title'])?></h2>
  <div style="margin-bottom:10px;display:flex;gap:6px;flex-wrap:wrap">
    <button class="toggle-btn" onclick="toggleReadingPinyin()">Hi&#7879;n pinyin</button>
    <button class="toggle-btn" onclick="toggleReadingVi()">Hi&#7879;n d&#7883;ch</button>
    <button class="toggle-btn" onclick="speak('<?=escape(preg_replace('/[。！？；：]/','。',$reading['content']))?>')">&#9654; &#272;&#7885;c to&agrave;n b&#7897;</button>
  </div>
  <div class="reading-box">
    <div id="readingContent"><?=nl2br(escape($reading['content']))?></div>
    <div class="pinyin-text" id="readingPinyin"><?=nl2br(escape($reading['pinyin'] ?? ''))?></div>
    <div class="vi-text" id="readingVi"><?=nl2br(escape($reading['translation'] ?? ''))?></div>
  </div>
  <?php if(!empty($reading['vocabulary_notes'])): ?>
  <div style="margin-top:8px;padding:12px;background:#fef3c7;border-radius:8px;font-size:.82rem;color:#b45309">
    <strong>&#128221; T&#7915; kh&oacute;:</strong> <?=nl2br(escape($reading['vocabulary_notes']))?>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>

<!-- SECTION 7: LISTENING -->
<?php if($listening): ?>
<div class="section-card" id="listening-section">
  <h2>&#127926; Luy&#7879;n nghe</h2>
  <div class="listening-card">
    <div style="margin-bottom:12px">
      <button class="btn btn--primary" onclick="speak('<?=escape(preg_replace('/[：:]/','。',$listening['transcript']))?>')">&#9654; Ph&aacute;t audio</button>
      <button class="toggle-btn" onclick="toggleListeningTranscript()">Hi&#7879;n transcript</button>
    </div>
    <div class="listening-transcript" id="listeningTranscript">
      <div style="font-weight:600">Transcript:</div>
      <p><?=nl2br(escape($listening['transcript']))?></p>
      <?php if(!empty($listening['transcript_pinyin'])): ?><p style="color:#94a3b8;font-size:.8rem"><?=nl2br(escape($listening['transcript_pinyin']))?></p><?php endif; ?>
      <?php if(!empty($listening['transcript_vi'])): ?><p style="color:#64748b"><?=nl2br(escape($listening['transcript_vi']))?></p><?php endif; ?>
    </div>
    <?php if(!empty($listening['questions'])): ?>
    <h4 style="font-weight:600;margin:12px 0 8px">C&acirc;u h&#7887;i nghe hi&#7875;u</h4>
    <?php foreach($listening['questions'] as $lq): ?>
    <div class="exercise-item" style="background:#fff;margin-top:8px">
      <div class="q"><?=escape($lq['question'])?></div>
      <?php if($lq['type']==='multiple_choice' && $lq['options']): 
        $opts = json_decode($lq['options'], true);
      ?>
      <div class="exercise-options" id="lq-opts-<?=$lq['id']?>">
        <?php foreach($opts as $oi=>$opt): ?>
        <label class="exercise-option" onclick="selectListeningOption(<?=$lq['id']?>,<?=$oi?>,this)">
          <input type="radio" name="lq-<?=$lq['id']?>" value="<?=$oi?>" style="display:none">
          <span><?=escape($opt)?></span>
        </label>
        <?php endforeach; ?>
      </div>
      <button class="toggle-btn" style="margin-top:6px" onclick="checkListening(<?=$lq['id']?>,'<?=escape($lq['answer'])?>')">Ki&#7875;m tra</button>
      <?php else: ?>
      <input type="text" class="exercise-fill-input" id="lq-input-<?=$lq['id']?>" placeholder="Nh&#7853;p c&acirc;u tr&#7843; l&#7901;i...">
      <button class="toggle-btn" style="margin-top:6px" onclick="checkListeningFill(<?=$lq['id']?>,'<?=escape($lq['answer'])?>')">Ki&#7875;m tra</button>
      <?php endif; ?>
      <div class="lq-result" id="lq-result-<?=$lq['id']?>" style="font-size:.8rem;margin-top:4px"></div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

<!-- SECTION 8: SPEAKING -->
<?php if(count($speaking)>0): ?>
<div class="section-card" id="speaking-section">
  <h2>&#128483; Luy&#7879;n n&oacute;i</h2>
  <?php foreach($speaking as $sp): ?>
  <div class="section-card speaking-card">
    <p style="color:#64748b;font-size:.85rem"><?=escape($sp['instruction'] ?? '')?></p>
    <div class="speaking-target"><?=escape($sp['target_text'])?></div>
    <div class="speaking-pinyin"><?=escape($sp['target_pinyin'] ?? '')?></div>
    <button class="toggle-btn" onclick="speak('<?=escape($sp['target_text'])?>')">&#9654; Nghe m&#7841;u</button>
    <button class="mic-btn" id="micBtn" onclick="startRecording()">&#127908;</button>
    <div id="speechResult" style="font-size:.85rem;color:#64748b;margin-top:8px"></div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- SECTION 9: WRITING -->
<?php if(count($writing)>0): ?>
<div class="section-card" id="writing-section">
  <h2>&#9997; Luy&#7879;n vi&#7871;t</h2>
  <?php foreach($writing as $w): ?>
  <div class="writing-card">
    <div class="writing-char"><?=escape($w['character_char'])?></div>
    <div class="stroke-number"><?=$w['stroke_count']?> n&eacute;t &middot; B&#7897; <?=escape($w['radical']??'')?></div>
    <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap">
      <button class="stroke-btn" onclick="showStrokeOrder('<?=escape($w['character_char'])?>')">&#9654; Xem th&#7913; t&#7921; n&eacute;t</button>
    </div>
    <canvas class="stroke-canvas" id="writingCanvas" width="200" height="200"></canvas>
    <div style="margin-top:8px">
      <button class="toggle-btn" onclick="clearCanvas()">X&oacute;a</button>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- SECTION 10: FLASHCARD -->
<div class="section-card" id="flashcard-section">
  <h2>&#128007; Flashcard</h2>
  <?php if(count($vocab)>0): ?>
  <div style="text-align:center;margin-bottom:12px">
    <button class="toggle-btn" onclick="prevFlashcard()">&#9664; Tr&#432;&#7899;c</button>
    <span id="fcCounter" style="font-size:.85rem;color:#64748b">1 / <?=count($vocab)?></span>
    <button class="toggle-btn" onclick="nextFlashcard()">Sau &#9654;</button>
  </div>
  <div class="flashcard-mini">
    <div class="flashcard-inner" id="flashcardInner" onclick="this.classList.toggle('flipped')">
      <div class="flashcard-face flashcard-front">
        <div class="fc-hanzi" id="fcHanzi"><?=escape($vocab[0]['hanzi'])?></div>
        <div style="font-size:.8rem;opacity:.7;margin-top:8px">Nh&#7845;n &#273;&#7875; xem</div>
      </div>
      <div class="flashcard-face flashcard-back">
        <div class="fc-pinyin" id="fcPinyin"><?=escape($vocab[0]['pinyin'])?></div>
        <div class="fc-meaning" id="fcMeaning"><?=escape($vocab[0]['meaning'])?></div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<!-- SECTION 11: EXERCISES -->
<div class="section-card" id="exercise-section">
  <h2>&#128221; B&agrave;i t&#7853;p</h2>
  <?php if(count($exercises)===0): ?><p style="color:#94a3b8;font-size:.85rem">Ch&#432;a c&oacute; d&#7919; li&#7879;u b&agrave;i t&#7853;p cho b&agrave;i n&agrave;y.</p><?php endif; ?>
  <div id="exerciseScore" style="display:none;padding:12px;border-radius:8px;margin-bottom:12px;font-weight:700;text-align:center"></div>
  <button class="btn btn--primary" onclick="checkAllExercises()" style="margin-bottom:16px">&#9989; Ch&#7845;m t&#7845;t c&#7843;</button>
  <?php foreach($exercises as $ei=>$ex): ?>
  <div class="exercise-item" id="ex-<?=$ei?>">
    <span style="font-size:.75rem;color:#94a3b8;font-weight:600;text-transform:uppercase">
      <?php 
        $types = ['fill_blank'=>'Điền từ','multiple_choice'=>'Trắc nghiệm','transform'=>'Biến đổi','sentence_order'=>'Sắp xếp','true_false'=>'Đúng/Sai','matching'=>'Nối từ','listening_write'=>'Nghe viết','choice_word'=>'Chọn từ','grammar_correction'=>'Sửa lỗi','reading_qa'=>'Đọc hiểu'];
        echo $types[$ex['type']] ?? $ex['type'];
      ?>
    </span>
    <div class="q"><?=nl2br(escape($ex['question']))?></div>
    <?php if($ex['type']==='multiple_choice' && $ex['options']): 
      $opts = json_decode($ex['options'], true);
    ?>
    <div class="exercise-options" id="ex-opts-<?=$ei?>">
      <?php foreach($opts as $oi=>$opt): ?>
      <label class="exercise-option" onclick="selectOption(<?=$ei?>,<?=$oi?>,this)">
        <input type="radio" name="ex-<?=$ei?>" value="<?=$oi?>" style="display:none">
        <span><?=escape($opt)?></span>
      </label>
      <?php endforeach; ?>
    </div>
    <?php elseif($ex['type']==='fill_blank'): ?>
    <input type="text" class="exercise-fill-input" id="ex-input-<?=$ei?>" placeholder="Nhập đáp án...">
    <?php elseif($ex['type']==='sentence_order'): ?>
    <div class="order-chips" id="ex-order-avail-<?=$ei?>">
      <?php $words = explode(' ', $ex['question']); shuffle($words); foreach($words as $w): ?>
      <span class="order-chip" onclick="toggleOrderChip(this,<?=$ei?>)" data-word="<?=escape($w)?>"><?=escape($w)?></span>
      <?php endforeach; ?>
    </div>
    <div class="order-chips" id="ex-order-ans-<?=$ei?>" style="border-style:dashed;min-height:36px"></div>
    <?php elseif($ex['type']==='true_false'): ?>
    <div class="exercise-options" id="ex-opts-<?=$ei?>">
      <label class="exercise-option" onclick="selectOption(<?=$ei?>,0,this)"><input type="radio" name="ex-<?=$ei?>" value="0" style="display:none"><span>✅ Đúng</span></label>
      <label class="exercise-option" onclick="selectOption(<?=$ei?>,1,this)"><input type="radio" name="ex-<?=$ei?>" value="1" style="display:none"><span>❌ Sai</span></label>
    </div>
    <?php elseif($ex['type']==='matching' && $ex['options']): 
      $pairs = json_decode($ex['options'], true); $left = array_keys($pairs); $right = array_values($pairs); shuffle($right);
    ?>
    <div class="matching-grid" id="ex-matching-<?=$ei?>">
      <div class="matching-col">
        <?php foreach($left as $li=>$lk): ?>
        <div class="matching-item" data-side="left" data-key="<?=$li?>" onclick="selectMatching(<?=$ei?>,this)"><?=escape($lk)?></div>
        <?php endforeach; ?>
      </div>
      <div class="matching-col">
        <?php foreach($right as $ri=>$rv): ?>
        <div class="matching-item" data-side="right" data-key="<?=$ri?>" data-val="<?=escape($rv)?>" onclick="selectMatching(<?=$ei?>,this)"><?=escape($rv)?></div>
        <?php endforeach; ?>
      </div>
    </div>
    <div id="ex-matching-status-<?=$ei?>" style="font-size:.8rem;color:#64748b;margin-top:4px"></div>
    <?php elseif($ex['type']==='listening_write'): ?>
    <button class="btn btn--primary" onclick="speakExercise(<?=$ei?>,'<?=escape($ex['question'])?>')">▶ Nghe và viết</button>
    <input type="text" class="exercise-fill-input" id="ex-input-<?=$ei?>" placeholder="Gõ những gì bạn nghe được..." style="margin-top:8px">
    <?php elseif($ex['type']==='choice_word' && $ex['options']): 
      $opts = json_decode($ex['options'], true);
    ?>
    <div class="exercise-options" id="ex-opts-<?=$ei?>">
      <?php foreach($opts as $oi=>$opt): ?>
      <label class="exercise-option" onclick="selectOption(<?=$ei?>,<?=$oi?>,this)">
        <input type="radio" name="ex-<?=$ei?>" value="<?=$oi?>" style="display:none">
        <span><?=escape($opt)?></span>
      </label>
      <?php endforeach; ?>
    </div>
    <?php elseif($ex['type']==='grammar_correction'): ?>
    <div class="grammar-correction">
      <div class="wrong-sentence"><?=escape($ex['question'])?></div>
      <input type="text" class="exercise-fill-input" id="ex-input-<?=$ei?>" placeholder="Nhập câu đã sửa...">
    </div>
    <?php elseif($ex['type']==='reading_qa'): ?>
    <div class="reading-qa">
      <p style="font-size:.85rem;color:#64748b;margin-bottom:4px"><?=escape($ex['question'])?></p>
      <textarea class="exercise-fill-input" id="ex-input-<?=$ei?>" rows="2" placeholder="Nhập câu trả lời..."></textarea>
    </div>
    <?php elseif($ex['type']==='transform'): ?>
    <p style="font-size:.85rem;color:#64748b;margin-bottom:4px">Viết lại câu theo yêu cầu:</p>
    <input type="text" class="exercise-fill-input" id="ex-input-<?=$ei?>" placeholder="Nhập câu đã biến đổi...">
    <?php endif; ?>
    <button class="toggle-btn" onclick="checkExercise(<?=$ei?>,'<?=escape($ex['answer'])?>','<?=$ex['type']?>')" style="margin-top:6px">Ki&#7875;m tra</button>
    <div id="ex-result-<?=$ei?>" style="font-size:.8rem;margin-top:4px"></div>
    <div id="ex-explain-<?=$ei?>" style="font-size:.78rem;color:#64748b;margin-top:2px;display:none"><?=escape($ex['explanation']??'')?></div>
  </div>
  <?php endforeach; ?>
</div>

<!-- SECTION 12: REVIEW VOCAB -->
<?php if(count($reviewVocab) > 0): ?>
<div class="section-card" id="review-section">
  <h2>&#128260; T&#7915; v&#7921;ng c&#7847;n &ocirc;n l&#7841;i <span class="count">t&#7915; b&agrave;i tr&#432;&#7899;c</span></h2>
  <div class="vocab-grid">
    <?php foreach($reviewVocab as $rv): ?>
    <div class="vocab-card" style="border-color:#fef3c7;background:#fffbeb">
      <div class="top">
        <span class="hanzi" onclick="speak('<?=escape($rv['hanzi'])?>')"><?=escape($rv['hanzi'])?></span>
        <button class="btn-play-sm" onclick="speak('<?=escape($rv['hanzi'])?>')">&#9654; &Ocirc;n</button>
      </div>
      <div class="pinyin"><?=escape($rv['pinyin'])?></div>
      <div class="meaning"><?=escape($rv['meaning'])?></div>
      <?php if($rv['example']): ?>
      <div class="example"><?=escape($rv['example'])?></div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<!-- SECTION 13: PERSONAL NOTES -->
<div class="section-card" id="notes-section">
  <h2>&#128221; Ghi ch&uacute; c&aacute; nh&acirc;n</h2>
  <textarea id="userNoteContent" style="width:100%;min-height:100px;padding:12px;border:2px solid #e2e8f0;border-radius:8px;font-size:.9rem;font-family:inherit;resize:vertical;box-sizing:border-box" placeholder="Vi&#7871;t ghi ch&uacute; c&#7911;a b&#7841;n v&#7873; b&agrave;i h&#7885;c n&agrave;y..."><?=escape($userNote['content'] ?? '')?></textarea>
  <button class="btn btn--primary" onclick="saveNote(<?=$lessonId?>)" style="margin-top:8px">&#128190; L&#432;u ghi ch&uacute;</button>
  <span id="noteStatus" style="font-size:.8rem;color:#64748b;margin-left:8px"></span>
</div>

<!-- SECTION 14: SUMMARY -->
<div class="section-card" id="summary-section">
  <h2>&#128202; T&#7893;ng k&#7871;t b&agrave;i h&#7885;c</h2>
  <div class="summary-grid">
    <div class="summary-card green">
      <div class="number"><?=count($vocab)?></div>
      <div>T&#7915; v&#7921;ng &dstrok;&atilde; h&#7885;c</div>
    </div>
    <div class="summary-card blue">
      <div class="number"><?=count($grammarList)?></div>
      <div>&#272;i&#7875;m ng&#7919; ph&aacute;p</div>
    </div>
    <div class="summary-card yellow">
      <div class="number"><?=count($exercises)?></div>
      <div>B&agrave;i t&#7853;p</div>
    </div>
    <div class="summary-card purple">
      <div class="number"><?=count($dialogues)?></div>
      <div>&#272;o&#7841;n h&#7897;i tho&#7841;i</div>
    </div>
  </div>
  <div style="text-align:center;margin:20px 0">
    <button class="btn btn--primary" id="completeBtn" onclick="markLessonCompleted(<?=$lessonId?>)" <?=$progress && $progress['is_completed'] ? 'disabled' : ''?>>
      <?=$progress && $progress['is_completed'] ? '&#2705; Đã hoàn thành' : '&#9989; Đánh dấu hoàn thành bài học'?>
    </button>
  </div>
  <div class="lesson-nav">
    <?php if($prevLesson): ?>
    <a href="<?=App\Helpers\View::baseUrl()?>/lesson/<?=$prevLesson['id']?>" class="prev">&larr; B&agrave;i tr&#432;&#7899;c</a>
    <?php else: ?>
    <span></span>
    <?php endif; ?>
    <?php if($nextLesson): ?>
    <a href="<?=App\Helpers\View::baseUrl()?>/lesson/<?=$nextLesson['id']?>" class="next">B&agrave;i ti&#7871;p theo: <?=escape($nextLesson['title'])?> &rarr;</a>
    <?php endif; ?>
  </div>
</div>

<script>
// ====== UTILITY FUNCTIONS ======
function speak(text) {
    if (!window.speechSynthesis) return;
    speechSynthesis.cancel();
    const u = new SpeechSynthesisUtterance(text);
    u.lang = 'zh-CN';
    u.rate = 0.75;
    const v = speechSynthesis.getVoices().find(function(v) { return /^zh/i.test(v.lang); });
    if (v) u.voice = v;
    speechSynthesis.speak(u);
}

function scrollToSection(id) {
    var el = document.getElementById(id);
    if (el) el.scrollIntoView({behavior:'smooth',block:'start'});
}

// ====== TAB NAV ======
document.querySelectorAll('.lesson-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.lesson-tab').forEach(function(t) { t.classList.remove('active'); });
        this.classList.add('active');
    });
});

// ====== DIALOGUE TRANSLATION TOGGLE ======
var dialogueViVisible = false;
function toggleAllVi() {
    dialogueViVisible = !dialogueViVisible;
    document.querySelectorAll('.dialogue-content').forEach(function(el) { el.classList.toggle('show-vi', dialogueViVisible); });
    document.getElementById('toggleViBtn').textContent = dialogueViVisible ? '&#7848;n b&#7843;n d&#7883;ch' : 'Hi&#7879;n b&#7843;n d&#7883;ch';
}

function playDialogue() {
    var sentences = document.querySelectorAll('#dialogue-section .dialogue-content .cn');
    var text = '';
    sentences.forEach(function(s) { text += s.textContent.replace('\u25B4','').trim() + '&#12290;'; });
    speak(text);
}

// ====== READING TOGGLES ======
function toggleReadingPinyin() {
    var el = document.getElementById('readingPinyin');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

function toggleReadingVi() {
    var el = document.getElementById('readingVi');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

// ====== LISTENING TOGGLES ======
function toggleListeningTranscript() {
    var el = document.getElementById('listeningTranscript');
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}

function selectListeningOption(qId, idx, el) {
    document.querySelectorAll('#lq-opts-' + qId + ' .exercise-option').forEach(function(o) { o.classList.remove('selected'); });
    el.classList.add('selected');
    el.querySelector('input').checked = true;
}

function checkListening(qId, answer) {
    var selected = document.querySelector('input[name="lq-' + qId + '"]:checked');
    var result = document.getElementById('lq-result-' + qId);
    if (!selected) { result.textContent = '\u274C Vui l&ograve;ng ch&#7885;n &dstrok;&aacute;p &aacute;n.'; result.style.color = '#b91c1c'; return; }
    var opts = document.querySelectorAll('#lq-opts-' + qId + ' .exercise-option span');
    var userAnswer = opts[parseInt(selected.value)]?.textContent || '';
    var isCorrect = userAnswer.trim() === answer.trim();
    document.querySelectorAll('#lq-opts-' + qId + ' .exercise-option').forEach(function(o,i) {
        o.classList.remove('correct','wrong');
        if (opts[i]?.textContent.trim() === answer.trim()) o.classList.add('correct');
    });
    if (!isCorrect) selected.closest('.exercise-option').classList.add('wrong');
    result.textContent = isCorrect ? '\u2705 Ch&iacute;nh x&aacute;c!' : '\u274C Sai. &Dstrok;&aacute;p &aacute;n: ' + answer;
    result.style.color = isCorrect ? '#047857' : '#b91c1c';
}

function checkListeningFill(qId, answer) {
    var input = document.getElementById('lq-input-' + qId);
    var result = document.getElementById('lq-result-' + qId);
    var clean = function(s) { return s.replace(/[\s\uFF0C\u3002\u3001\uFF01\uFF1F\uFF1B\uFF1A,\.!?;:'"]/g,'').toLowerCase(); };
    var isCorrect = clean(input.value) === clean(answer);
    result.textContent = isCorrect ? '\u2705 Ch&iacute;nh x&aacute;c!' : '\u274C Sai. &Dstrok;&aacute;p &aacute;n: ' + answer;
    result.style.color = isCorrect ? '#047857' : '#b91c1c';
}

// ====== SPEAKING (Web Speech API) ======
var recognition = null;
function startRecording() {
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
        document.getElementById('speechResult').textContent = 'Tr&igrave;nh duy&#7879;t kh&ocirc;ng h&#7895; tr&#7907; ghi &acirc;m.';
        return;
    }
    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!recognition) {
        recognition = new SpeechRecognition();
        recognition.lang = 'zh-CN';
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.onresult = function(event) {
            var transcript = event.results[0][0].transcript;
            document.getElementById('speechResult').innerHTML = 'B&#7841;n &dstrok;&atilde; n&oacute;i: <strong>' + transcript + '</strong>';
            document.getElementById('micBtn').classList.remove('recording');
        };
        recognition.onerror = function() {
            document.getElementById('speechResult').textContent = 'Kh&ocirc;ng th&#7875; nh&#7853;n di&#7879;n gi&#7885;ng n&oacute;i.';
            document.getElementById('micBtn').classList.remove('recording');
        };
        recognition.onend = function() {
            document.getElementById('micBtn').classList.remove('recording');
        };
    }
    recognition.start();
    document.getElementById('micBtn').classList.add('recording');
    document.getElementById('speechResult').textContent = '&Dstrok;ang nghe...';
}

// ====== WRITING CANVAS ======
var canvas, ctx, isDrawing = false;
document.addEventListener('DOMContentLoaded', function() {
    canvas = document.getElementById('writingCanvas');
    if (canvas) {
        ctx = canvas.getContext('2d');
        ctx.strokeStyle = '#102a56';
        ctx.lineWidth = 3;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        canvas.addEventListener('mousedown', startDraw);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDraw);
        canvas.addEventListener('mouseleave', stopDraw);
        canvas.addEventListener('touchstart', function(e) { e.preventDefault(); startDraw(e.touches[0]); });
        canvas.addEventListener('touchmove', function(e) { e.preventDefault(); draw(e.touches[0]); });
        canvas.addEventListener('touchend', stopDraw);
    }
});

function getPos(e) {
    var rect = canvas.getBoundingClientRect();
    var clientX = e.clientX || (e.pageX || 0);
    var clientY = e.clientY || (e.pageY || 0);
    return { x: clientX - rect.left, y: clientY - rect.top };
}

function startDraw(e) {
    isDrawing = true;
    var pos = getPos(e);
    ctx.beginPath();
    ctx.moveTo(pos.x, pos.y);
}

function draw(e) {
    if (!isDrawing) return;
    var pos = getPos(e);
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
}

function stopDraw() { isDrawing = false; }

function clearCanvas() {
    if (ctx) ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function showStrokeOrder(char) {
    clearCanvas();
    if (ctx) {
        ctx.font = '120px serif';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = '#e2e8f0';
        ctx.fillText(char, 100, 100);
        ctx.strokeStyle = '#0f766e';
        ctx.lineWidth = 3;
        ctx.strokeText(char, 100, 100);
    }
}

// ====== FLASHCARD MINI ======
var fcIndex = 0;
var fcData = <?=json_encode(array_map(function($v) {
    return ['hanzi'=>$v['hanzi'], 'pinyin'=>$v['pinyin'], 'meaning'=>$v['meaning']];
}, $vocab))?>;

function updateFlashcard() {
    if (fcData.length === 0) return;
    var data = fcData[fcIndex];
    document.getElementById('fcHanzi').textContent = data.hanzi;
    document.getElementById('fcPinyin').textContent = data.pinyin;
    document.getElementById('fcMeaning').textContent = data.meaning;
    document.getElementById('fcCounter').textContent = (fcIndex + 1) + ' / ' + fcData.length;
    document.getElementById('flashcardInner').classList.remove('flipped');
}

function nextFlashcard() { if (fcIndex < fcData.length - 1) { fcIndex++; updateFlashcard(); } }
function prevFlashcard() { if (fcIndex > 0) { fcIndex--; updateFlashcard(); } }

// ====== EXERCISES ======
function selectOption(exIdx, optIdx, el) {
    document.querySelectorAll('#ex-opts-' + exIdx + ' .exercise-option').forEach(function(o) { o.classList.remove('selected'); });
    el.classList.add('selected');
    el.querySelector('input').checked = true;
}

function selectMatching(exIdx, el) {
    var grid = document.getElementById('ex-matching-' + exIdx);
    var side = el.dataset.side;
    grid.querySelectorAll('[data-side="' + side + '"].selected').forEach(function(o) { o.classList.remove('selected'); });
    el.classList.add('selected');
    var left = grid.querySelector('[data-side=left].selected');
    var right = grid.querySelector('[data-side=right].selected');
    if (left && right) {
        document.getElementById('ex-matching-status-' + exIdx).textContent = 'Đã chọn: ' + left.textContent.trim() + ' ↔ ' + right.textContent.trim();
    } else {
        document.getElementById('ex-matching-status-' + exIdx).textContent = 'Chọn một mục mỗi cột rồi bấm Kiểm tra';
    }
}

function speakExercise(exIdx, text) {
    if ('speechSynthesis' in window) {
        var msg = new SpeechSynthesisUtterance(text);
        msg.lang = 'zh-CN';
        msg.rate = 0.8;
        speechSynthesis.speak(msg);
    } else {
        alert('Trình duyệt không hỗ trợ đọc văn bản.');
    }
}

function toggleOrderChip(el, exIdx) {
    if (el.classList.contains('selected')) {
        el.classList.remove('selected');
        document.getElementById('ex-order-ans-' + exIdx).removeChild(el);
        document.getElementById('ex-order-avail-' + exIdx).appendChild(el);
    } else {
        el.classList.add('selected');
        document.getElementById('ex-order-ans-' + exIdx).appendChild(el);
    }
}

function checkExercise(exIdx, answer, type) {
    var result = document.getElementById('ex-result-' + exIdx);
    var explain = document.getElementById('ex-explain-' + exIdx);
    var isCorrect = false;
    
    if (type === 'multiple_choice' || type === 'choice_word') {
        var selected = document.querySelector('input[name="ex-' + exIdx + '"]:checked');
        if (!selected) { result.textContent = '❌ Vui lòng chọn đáp án.'; result.style.color = '#b91c1c'; return; }
        var opts = document.querySelectorAll('#ex-opts-' + exIdx + ' .exercise-option span');
        var userAnswer = opts[parseInt(selected.value)]?.textContent || '';
        isCorrect = userAnswer.trim() === answer.trim();
        document.querySelectorAll('#ex-opts-' + exIdx + ' .exercise-option').forEach(function(o,i) {
            o.classList.remove('correct','wrong');
            if (opts[i]?.textContent.trim() === answer.trim()) o.classList.add('correct');
        });
        if (!isCorrect) selected.closest('.exercise-option').classList.add('wrong');
    } else if (type === 'true_false') {
        var selected = document.querySelector('input[name="ex-' + exIdx + '"]:checked');
        if (!selected) { result.textContent = '❌ Vui lòng chọn Đúng hoặc Sai.'; result.style.color = '#b91c1c'; return; }
        isCorrect = selected.value === answer;
        document.querySelectorAll('#ex-opts-' + exIdx + ' .exercise-option').forEach(function(o,i) {
            o.classList.remove('correct','wrong');
            if ((answer === '0' && i === 0) || (answer === '1' && i === 1)) o.classList.add('correct');
        });
        if (!isCorrect) selected.closest('.exercise-option').classList.add('wrong');
    } else if (type === 'fill_blank' || type === 'listening_write' || type === 'grammar_correction' || type === 'reading_qa') {
        var input = document.getElementById('ex-input-' + exIdx);
        var clean = function(s) { return s.replace(/[\s\uFF0C\u3002\u3001\uFF01\uFF1F\uFF1B\uFF1A,\.!?;:'"]/g,''); };
        isCorrect = clean(input.value).includes(clean(answer)) || clean(answer).includes(clean(input.value));
        input.className = 'exercise-fill-input ' + (isCorrect ? 'correct' : 'wrong');
    } else if (type === 'sentence_order') {
        var ans = document.getElementById('ex-order-ans-' + exIdx);
        var userOrder = Array.from(ans.children).map(function(c) { return c.dataset.word; }).join('');
        var clean = function(s) { return s.replace(/[\s\uFF0C\u3002\u3001\uFF01\uFF1F\uFF1B\uFF1A,\.!?;:'"]/g,''); };
        isCorrect = clean(userOrder) === clean(answer);
    } else if (type === 'matching') {
        var leftItems = document.querySelectorAll('#ex-matching-' + exIdx + ' [data-side=left].selected');
        var rightItems = document.querySelectorAll('#ex-matching-' + exIdx + ' [data-side=right].selected');
        if (leftItems.length === 0 || rightItems.length === 0) { result.textContent = '❌ Chọn một mục bên trái và một mục bên phải.'; result.style.color = '#b91c1c'; return; }
        var pairs = JSON.parse(answer);
        var li = leftItems[0].dataset.key;
        var rv = rightItems[0].dataset.val;
        isCorrect = pairs[li] === rv;
        if (isCorrect) { leftItems[0].classList.add('correct'); rightItems[0].classList.add('correct'); }
        else { leftItems[0].classList.add('wrong'); rightItems[0].classList.add('wrong'); }
    } else if (type === 'transform') {
        var input = document.getElementById('ex-input-' + exIdx);
        isCorrect = input ? input.value.trim().length > 0 : false;
        if (input) input.className = 'exercise-fill-input ' + (isCorrect ? 'correct' : 'wrong');
    }
    
    result.textContent = isCorrect ? '✅ Chính xác!' : '❌ Sai. Đáp án: ' + answer;
    result.style.color = isCorrect ? '#047857' : '#b91c1c';
    if (explain && explain.textContent.trim()) explain.style.display = 'block';
}

function checkAllExercises() {
    var total = <?=count($exercises)?>;
    var correct = 0;
    var checked = 0;
    document.querySelectorAll('.exercise-item').forEach(function(item, idx) {
        var result = document.getElementById('ex-result-' + idx);
        if (result && result.textContent) {
            checked++;
            if (result.textContent.indexOf('\u2705') !== -1) correct++;
        }
    });
    var score = document.getElementById('exerciseScore');
    score.style.display = 'block';
    if (checked === 0) {
        score.textContent = 'H&atilde;y l&agrave;m t&#7915;ng b&agrave;i t&#7853;p tr&#432;&#7899;c, sau &dstrok;&oacute; ch&#7845;m &dstrok;i&#7875;m!';
        score.style.background = '#fef3c7';
        score.style.color = '#b45309';
    } else {
        score.textContent = '\u2705 ' + correct + '/' + checked + ' &dstrok;&uacute;ng (' + Math.round(correct/checked*100) + '%)';
        score.style.background = correct === checked ? '#d1fae5' : '#dbeafe';
        score.style.color = correct === checked ? '#047857' : '#1d4ed8';
    }
}

// ====== VOCAB ACTIONS ======
function toggleFav(vocabId, btn) {
    var userId = localStorage.getItem('hanngu_user_id') || 'default_user';
    fetch('api.php?action=toggle_favorite', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ vocab_id: vocabId, user_id: userId })
    }).then(function(r) { return r.json(); }).then(function(data) {
        if (data.success) {
            btn.textContent = '\u2764 &Dstrok;&atilde; th&iacute;ch';
            btn.style.background = '#fecaca';
        }
    });
}

function markLearned(vocabId, btn) {
    btn.textContent = '\u2713 &Dstrok;&atilde; h&#7885;c';
    btn.style.background = '#bbf7d0';
}

// ====== SAVE NOTE ======
function saveNote(lessonId) {
    var content = document.getElementById('userNoteContent').value;
    var status = document.getElementById('noteStatus');
    fetch('api.php?action=save_note', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ lesson_id: lessonId, content: content })
    }).then(function(r) { return r.json(); }).then(function(data) {
        if (data.success) {
            status.textContent = '\u2705 &Dstrok;&atilde; l&#432;u!';
            status.style.color = '#047857';
        } else {
            status.textContent = '\u274C L&#7895;i l&#432;u ghi ch&uacute;';
            status.style.color = '#b91c1c';
        }
        setTimeout(function() { status.textContent = ''; }, 3000);
    }).catch(function() {
        status.textContent = '\u274C L&#7895;i k&#7871;t n&#7889;i';
        status.style.color = '#b91c1c';
    });
}

// ====== MARK LESSON COMPLETED ======
function markLessonCompleted(lessonId) {
    fetch('api.php?action=complete_lesson', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ lesson_id: lessonId })
    }).then(function(r) { return r.json(); }).then(function(data) {
        if (data.success) {
            var btn = document.getElementById('completeBtn');
            if (btn) {
                btn.textContent = '\u2705 &Dstrok;&atilde; ho&agrave;n th&agrave;nh';
                btn.className = 'btn btn--success';
                btn.disabled = true;
            }
        }
    });
}

// Initialize speech voices
if ('speechSynthesis' in window) {
    speechSynthesis.onvoiceschanged = function() { speechSynthesis.getVoices(); };
}
</script>
</main>
