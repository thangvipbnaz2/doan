<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cộng đồng học tiếng Trung - Chia sẻ kinh nghiệm, thảo luận và kết nối.">
    <title>Cộng đồng - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="community.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="community-page">
        <div class="container">
            <div class="page-header">
                <div class="page-header__text">
                    <span class="page-header__badge"> Cộng đồng</span>
                    <h1 class="page-header__title">Cùng nhau <span class="text-gradient">học và chia sẻ</span></h1>
                    <p class="page-header__desc">Đặt câu hỏi, chia sẻ kinh nghiệm và kết nối với bạn học.</p>
                </div>
            </div>

            <div class="community-layout">
                <div class="community-main">
                    <div class="fb-post-box" id="post-form-card">
                        <div class="fb-post-box__trigger" id="post-form-trigger">
                            <div class="post-avatar fb-post-avatar" id="trigger-avatar">H</div>
                            <span class="fb-post-box__placeholder">Bạn đang nghĩ gì?</span>
                        </div>
                        <form id="post-form" class="fb-post-box__form" style="display:none">
                            <div class="fb-post-box__header">
                                <div class="post-avatar fb-post-avatar" id="form-avatar">H</div>
                                <div class="fb-post-box__author-wrap">
                                    <span class="fb-post-box__author-label">Đăng bởi</span>
                                    <input type="text" id="post-author" placeholder="Tên của bạn" required>
                                </div>
                            </div>
                            <input type="text" id="post-title" placeholder="Tiêu đề bài viết" required>
                            <textarea id="post-content" rows="3" placeholder="Bạn đang nghĩ gì?" required></textarea>
                            <div class="tag-selector" id="tag-selector">
                                <label class="tag-check"><input type="checkbox" value="#HSK1"><span>#HSK1</span></label>
                                <label class="tag-check"><input type="checkbox" value="#HSK2"><span>#HSK2</span></label>
                                <label class="tag-check"><input type="checkbox" value="#HSK3"><span>#HSK3</span></label>
                                <label class="tag-check"><input type="checkbox" value="#HSK4"><span>#HSK4</span></label>
                                <label class="tag-check"><input type="checkbox" value="#HSK5"><span>#HSK5</span></label>
                                <label class="tag-check"><input type="checkbox" value="#HSK6"><span>#HSK6</span></label>
                                <label class="tag-check"><input type="checkbox" value="#NguPhap"><span>#NgữPháp</span></label>
                                <label class="tag-check"><input type="checkbox" value="#TuVung"><span>#TừVựng</span></label>
                                <label class="tag-check"><input type="checkbox" value="#MeoHoc"><span>#MẹoHọc</span></label>
                                <label class="tag-check"><input type="checkbox" value="#Pinyin"><span>#Pinyin</span></label>
                                <label class="tag-check"><input type="checkbox" value="#GiaoTiep"><span>#GiaoTiếp</span></label>
                            </div>
                            <div class="fb-post-box__actions">
                                <button type="button" class="fb-post-box__cancel" id="post-cancel">Huỷ</button>
                                <button type="submit" class="btn btn--primary ripple" id="btn-post">Đăng bài</button>
                            </div>
                        </form>
                    </div>

                    <div class="search-bar">
                        <span class="search-bar__icon"></span>
                        <input type="text" class="search-bar__input" id="search-input" placeholder="Tìm kiếm bài viết..." autocomplete="off">
                    </div>
                    <div class="sort-bar">
                        <button class="sort-btn sort-btn--active" data-sort="newest">🆕 Mới nhất</button>
                        <button class="sort-btn" data-sort="oldest"> Cũ nhất</button>
                        <button class="sort-btn" data-sort="popular"> Nổi bật</button>
                    </div>
                    <div class="my-posts-badge" id="my-posts-badge" style="display:none"> Bài viết của tôi <button id="my-posts-clear" aria-label="Xoá bộ lọc">✕</button></div>
                    <div class="posts-list" id="posts-list"><div style="display:flex;flex-direction:column;gap:16px;padding:20px 0;"><div class="skeleton skeleton--card" style="height:120px;"></div><div class="skeleton skeleton--card" style="height:120px;"></div><div class="skeleton skeleton--card" style="height:120px;"></div></div>
                        <div class="posts-empty empty-state-float" id="posts-empty" style="display:none">
                            <div class="posts-empty__icon"></div>
                            <h3>Chưa có bài đăng nào</h3>
                            <p>Hãy là người đầu tiên chia sẻ!</p>
                        </div>
                    </div>
                </div>

                <aside class="community-sidebar">
                    <div class="sidebar-card">
                        <h3 class="sidebar-card__title"> Thống kê</h3>
                        <div class="sidebar-stats">
                            <div class="sidebar-stat"><span class="sidebar-stat__num" id="stat-posts">0</span><span class="sidebar-stat__label">Bài đăng</span></div>
                            <div class="sidebar-stat"><span class="sidebar-stat__num" id="stat-likes">0</span><span class="sidebar-stat__label">Lượt thích</span></div>
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <h3 class="sidebar-card__title"> Thẻ tag phổ biến</h3>
                        <div class="tag-cloud" id="tag-cloud"></div>
                    </div>

                    <div class="sidebar-card">
                        <h3 class="sidebar-card__title"> Nội quy</h3>
                        <ul class="sidebar-rules">
                            <li>Tôn trọng mọi người</li>
                            <li>Sử dụng tiếng Việt hoặc tiếng Trung</li>
                            <li>Không spam hoặc quảng cáo</li>
                            <li>Gắn tag phù hợp cho bài viết</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </main>
    
    <script>
    // Loading spinner
    const LO = document.getElementById('loading-overlay');
    function showLoading(){if(LO)LO.style.display='flex';}
    function hideLoading(){if(LO)LO.style.display='none';}
    // Auto-hide on load
    document.addEventListener('DOMContentLoaded',hideLoading);
    window.addEventListener('load',hideLoading);
    </script>

    <footer class="footer"><div class="footer__bottom"><div class="container"><p>&copy; 2026 HànNgữ. Thiết kế với  cho cộng đồng học tiếng Trung.</p></div></div></footer>

<script>
const API_URL = 'api.php';
const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';
async function fetchAPI(action, data = null, method = 'GET') {
    try {
        let url = `${API_URL}?action=${action}`;
        let options = { method, headers: { 'Content-Type': 'application/json' } };
        if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
        else if (data) options.body = JSON.stringify(data);
        return await (await fetch(url, options)).json();
    } catch (e) { showToast(' Lỗi kết nối!', 'error'); return null; }
}
let currentTag = '';
let currentPage = 1;
let searchQuery = '';
let searchTimer = null;
const currentUserId = localStorage.getItem('hanngu_user_id') || '';
let currentSort = 'newest';
let myPostsMode = new URLSearchParams(window.location.search).get('my') === '1';

// Facebook-style post form toggle
const dn = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username') || 'H';
const userLetter = dn[0].toUpperCase();
document.getElementById('trigger-avatar').textContent = userLetter;
document.getElementById('form-avatar').textContent = userLetter;

document.getElementById('post-form-trigger')?.addEventListener('click', function() {
    const name = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username') || '';
    if (name) document.getElementById('post-author').value = name;
    document.getElementById('form-avatar').textContent = (name || 'H')[0].toUpperCase();
    document.getElementById('post-form-trigger').style.display = 'none';
    document.getElementById('post-form').style.display = 'block';
    document.getElementById('post-title').focus();
});

document.getElementById('post-cancel')?.addEventListener('click', function() {
    document.getElementById('post-form').reset();
    document.getElementById('post-form').style.display = 'none';
    document.getElementById('post-form-trigger').style.display = 'flex';
});

async function loadPosts(page = 1) {
    currentPage = page;
    const list = document.getElementById('posts-list');
    const empty = document.getElementById('posts-empty');
    const postsEl = document.getElementById('stat-posts');
    const likesEl = document.getElementById('stat-likes');
    list.innerHTML = '<div class="loading-pulse">Đang tải...</div>';
    const params = { tag: currentTag, page: currentPage, limit: 10, search: searchQuery, sort: currentSort, user_id: currentUserId };
    if (myPostsMode) {
        params.author = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username') || '';
        document.getElementById('my-posts-badge').style.display = 'flex';
    } else {
        document.getElementById('my-posts-badge').style.display = 'none';
    }
    const result = await fetchAPI('get_posts', params);
    if (result?.error) { showToast(' ' + result.error, 'error', 6000); }
    const posts = result?.data || [];
    const totalPosts = result?.total || 0;
    const totalPages = result?.pages || 1;

    if (postsEl) postsEl.textContent = totalPosts;
    const totalLikes = posts.reduce((s, p) => s + (p.likes || 0), 0);
    if (likesEl) likesEl.textContent = totalLikes;

    if (posts.length === 0) {
        if (empty) empty.style.display = 'block';
        list.innerHTML = '';
        if (empty) list.appendChild(empty);
        return;
    }

    if (empty) empty.style.display = 'none';
    list.innerHTML = posts.map((p, i) => {
        const tags = (p.tags || '').split(',').filter(t => t).map(t => `<span class="post-tag">${t}</span>`).join('');
        const avatarLetter = (p.author || 'A')[0].toUpperCase();
        return `
        <article class="post-card" style="animation-delay:${i*0.06}s">
            <div class="post-card__header">
                <div class="post-avatar">${avatarLetter}</div>
                <div class="post-card__meta">
                    <span class="post-author">${escapeHtml(p.author || 'Ẩn danh')}</span>
                    <span class="post-date">${p.created_at || ''}</span>
                </div>
            </div>
            <h3 class="post-card__title">${escapeHtml(p.title)}</h3>
            <p class="post-card__content">${escapeHtml(p.content)}</p>
            <div class="post-card__tags">${tags}</div>
            <div class="post-card__actions">
                <button class="post-action ripple ${p.liked ? 'post-action--liked' : ''}" data-action="like" data-id="${p.id}">
                    <span class="post-action__icon">${p.liked ? '' : ''}</span>
                    <span>${p.likes || 0}</span>
                </button>
                <button class="post-action ripple" data-action="comments" data-id="${p.id}">
                    <span class="post-action__icon"></span>
                    <span class="cmt-count-${p.id}">0</span>
                </button>
                <button class="post-action ripple post-action--delete" data-action="delete" data-id="${p.id}">
                    <span>Xoá</span>
                </button>
            </div>
            <div class="comments-section" id="comments-${p.id}" style="display:none">
                <div class="comments-list" id="comments-list-${p.id}"></div>
                <div class="comment-form">
                    <input type="text" class="comment-input" data-post="${p.id}" placeholder="Viết bình luận...">
                    <button class="comment-submit" data-post="${p.id}">Gửi</button>
                </div>
            </div>
        </article>`;
    }).join('');

    // Pagination
    const paginationHtml = totalPages > 1 ? `
    <div class="pagination">
        <button class="btn btn--sm btn--outline ripple" data-page="${currentPage-1}" ${currentPage <= 1 ? 'disabled' : ''}>←</button>
        ${Array.from({length: totalPages}, (_, i) => i+1).map(p => `
            <button class="btn btn--sm ripple ${p === currentPage ? 'btn--primary' : 'btn--outline'}" data-page="${p}">${p}</button>
        `).join('')}
        <button class="btn btn--sm btn--outline ripple" data-page="${currentPage+1}" ${currentPage >= totalPages ? 'disabled' : ''}>→</button>
    </div>` : '';
    list.insertAdjacentHTML('beforeend', paginationHtml);

    // Event listeners
    list.querySelectorAll('.post-action').forEach(btn => {
        btn.addEventListener('click', async () => {
            const action = btn.dataset.action;
            const id = parseInt(btn.dataset.id);
            if (action === 'like') {
                const res = await fetchAPI('like_post', { id: id, user_id: currentUserId });
                if (res) {
                    const isLiked = res.liked;
                    const icon = btn.querySelector('.post-action__icon');
                    const count = btn.querySelector('span:last-child');
                    if (icon) icon.textContent = isLiked ? '' : '';
                    btn.classList.toggle('post-action--liked', isLiked);
                    if (count) count.textContent = Math.max(0, parseInt(count.textContent) + (isLiked ? 1 : -1));
                    const likesStat = document.getElementById('stat-likes');
                    if (likesStat) {
                        const cur = parseInt(likesStat.textContent);
                        likesStat.textContent = Math.max(0, cur + (isLiked ? 1 : -1));
                    }
                }
            }
            if (action === 'delete') {
                showConfirm('Bạn có chắc muốn xóa bài viết này?', 'Xóa bài viết').then(async function(r){
                    if (r) {
                        await fetchAPI('delete_post', { id: id });
                        loadPosts(currentPage);
                        showToast(' Đã xóa bài viết!', 'success');
                    }
                });
            }
            if (action === 'comments') {
                const section = document.getElementById('comments-' + id);
                if (section.style.display === 'none') {
                    section.style.display = 'block';
                    loadComments(id);
                } else {
                    section.style.display = 'none';
                }
            }
        });
    });

    // Pagination buttons
    list.querySelectorAll('[data-page]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (!btn.disabled) loadPosts(parseInt(btn.dataset.page));
        });
    });

    // Comment submit
    list.querySelectorAll('.comment-submit').forEach(btn => {
        btn.addEventListener('click', async () => {
            const postId = parseInt(btn.dataset.post);
            const input = document.querySelector(`.comment-input[data-post="${postId}"]`);
            const content = input?.value?.trim();
            if (!content) return;
            const currentUser = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username') || 'Ẩn danh';
            await fetchAPI('add_comment', { post_id: postId, content, author: currentUser }, 'POST');
            input.value = '';
            loadComments(postId);
            showToast(' Đã thêm bình luận!', 'success', 2000);
        });
    });

    // Enter key for comments
    list.querySelectorAll('.comment-input').forEach(input => {
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const btn = document.querySelector(`.comment-submit[data-post="${input.dataset.post}"]`);
                if (btn) btn.click();
            }
        });
    });

    renderTagCloud(posts);
}

async function loadComments(postId) {
    const comments = await fetchAPI('get_comments', { post_id: postId });
    const list = document.getElementById('comments-list-' + postId);
    const countEl = document.querySelector('.cmt-count-' + postId);
    if (!list) return;
    const currentUser = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username') || '';
    if (!comments || comments.length === 0) {
        list.innerHTML = '<div class="comments-empty">Chưa có bình luận.</div>';
        if (countEl) countEl.textContent = '0';
        return;
    }
    function renderComment(c, isReply) {
        const letter = (c.author || 'A')[0].toUpperCase();
        const isOwn = c.author === currentUser;
        const cls = isReply ? 'comment-reply' : '';
        return `
        <div class="${cls}">
        <div class="comment-item">
            <div class="comment-avatar">${letter}</div>
            <div class="comment-body">
                <div class="comment-head">
                    <div class="comment-meta">
                        <strong>${escapeHtml(c.author)}</strong>
                        <span class="comment-time">${c.created_at || ''}</span>
                    </div>
                    <div class="comment-menu" data-comment-id="${c.id}">
                        <button class="comment-menu__btn">⋯</button>
                        <div class="comment-menu__dropdown" style="display:none">
                            ${isOwn ? `<button class="comment-menu__item" data-action="delete-comment"> Xoá</button>` : ''}
                            <button class="comment-menu__item" data-action="reply"> Trả lời</button>
                        </div>
                    </div>
                </div>
                <div class="comment-text">${escapeHtml(c.content)}</div>
            </div>
        </div>
        <div class="reply-form" id="reply-form-${postId}-${c.id}" style="display:none">
            <input type="text" class="reply-input" placeholder="Viết trả lời...">
            <button class="reply-submit" data-post="${postId}" data-parent="${c.id}">Gửi</button>
        </div>
        ${(c.replies && c.replies.length) ? c.replies.map(r => renderComment(r, true)).join('') : ''}
        </div>`;
    }
    list.innerHTML = comments.map(c => renderComment(c, false)).join('');
    if (countEl) countEl.textContent = comments.reduce((sum, c) => sum + 1 + (c.replies ? c.replies.length : 0), 0);

    // Comment menu toggle
    list.querySelectorAll('.comment-menu__btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const dd = this.parentElement.querySelector('.comment-menu__dropdown');
            const isOpen = dd.style.display !== 'none';
            document.querySelectorAll('.comment-menu__dropdown').forEach(d => d.style.display = 'none');
            dd.style.display = isOpen ? 'none' : 'block';
        });
    });
    document.addEventListener('click', function() {
        document.querySelectorAll('.comment-menu__dropdown').forEach(d => d.style.display = 'none');
    });

    // Delete comment
    list.querySelectorAll('.comment-menu__item[data-action="delete-comment"]').forEach(btn => {
        btn.addEventListener('click', async function() {
            const menu = this.closest('.comment-menu');
            const commentId = parseInt(menu.dataset.commentId);
            showConfirm('Xoá bình luận này?', 'Xác nhận').then(async function(r) {
                if (r) {
                    await fetchAPI('delete_comment', { id: commentId });
                    showToast(' Đã xoá bình luận!', 'success');
                    loadComments(postId);
                }
            });
        });
    });

    // Reply button
    list.querySelectorAll('.comment-menu__item[data-action="reply"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const menu = this.closest('.comment-menu');
            const commentId = parseInt(menu.dataset.commentId);
            const replyForm = document.getElementById('reply-form-' + postId + '-' + commentId);
            if (replyForm) {
                const wasOpen = replyForm.style.display !== 'none';
                document.querySelectorAll('.reply-form').forEach(f => f.style.display = 'none');
                replyForm.style.display = wasOpen ? 'none' : 'block';
                if (!wasOpen) replyForm.querySelector('.reply-input').focus();
            }
        });
    });

    // Reply submit
    list.querySelectorAll('.reply-submit').forEach(btn => {
        btn.addEventListener('click', async function() {
            const parentId = parseInt(this.dataset.parent);
            const input = this.parentElement.querySelector('.reply-input');
            const content = input?.value?.trim();
            if (!content) return;
            await fetchAPI('add_comment', { post_id: postId, parent_id: parentId, content, author: currentUser || 'Ẩn danh', user_id: USER_ID }, 'POST');
            input.value = '';
            this.parentElement.style.display = 'none';
            loadComments(postId);
            showToast(' Đã trả lời!', 'success', 2000);
        });
    });

    // Enter key for replies
    list.querySelectorAll('.reply-input').forEach(input => {
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const btn = input.parentElement.querySelector('.reply-submit');
                if (btn) btn.click();
            }
        });
    });
}

function renderTagCloud(posts) {
    const tagCount = {};
    posts.forEach(p => (p.tags || '').split(',').forEach(t => { if (t) tagCount[t] = (tagCount[t] || 0) + 1; }));
    const cloud = document.getElementById('tag-cloud');
    const allTags = ['#HSK1', '#HSK2', '#HSK3', '#HSK4', '#HSK5', '#HSK6', '#NguPhap', '#TuVung', '#MeoHoc', '#Pinyin', '#GiaoTiep'];
    cloud.innerHTML = allTags.map(t => `
        <button class="cloud-tag ${currentTag === t ? 'cloud-tag--active' : ''}" data-tag="${t}">
            ${t} <span class="cloud-tag__count">${tagCount[t] || 0}</span>
        </button>`).join('');

    cloud.querySelectorAll('.cloud-tag').forEach(btn => {
        btn.addEventListener('click', () => {
            currentTag = currentTag === btn.dataset.tag ? '' : btn.dataset.tag;
            currentPage = 1;
            loadPosts(1);
        });
    });
}

document.getElementById('post-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const title = document.getElementById('post-title').value.trim();
    const content = document.getElementById('post-content').value.trim();
    const author = document.getElementById('post-author').value.trim();
    const tags = [];
    document.querySelectorAll('#tag-selector input:checked').forEach(c => tags.push(c.value));

    if (!title || !content) return;

    const result = await fetchAPI('add_post', { title, content, author, tags }, 'POST');
    if (result && result.success) {
        document.getElementById('post-form').reset();
        document.getElementById('post-form').style.display = 'none';
        document.getElementById('post-form-trigger').style.display = 'flex';
        loadPosts(1);
        showToast(' Đã đăng bài thành công!', 'success');
    }
});

function escapeHtml(t) {
    if (!t) return '';
    const d = document.createElement('div');
    d.textContent = t;
    return d.innerHTML;
}

function sanitizeInput(val) {
    return val.replace(/[<>&"']/g, function(m) {
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        if (m === '&') return '&amp;';
        if (m === '"') return '&quot;';
        if (m === "'") return '&#39;';
        return m;
    });
}

document.getElementById('post-title').addEventListener('input', function() { this.value = sanitizeInput(this.value); });
document.getElementById('post-content').addEventListener('input', function() { this.value = sanitizeInput(this.value); });
document.getElementById('post-author').addEventListener('input', function() { this.value = sanitizeInput(this.value); });

// Search with debounce
document.getElementById('search-input')?.addEventListener('input', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        searchQuery = this.value.trim();
        currentTag = '';
        currentPage = 1;
        loadPosts(1);
    }, 300);
});

// Sort buttons
document.querySelectorAll('.sort-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('sort-btn--active'));
        this.classList.add('sort-btn--active');
        currentSort = this.dataset.sort;
        currentPage = 1;
        loadPosts(1);
    });
});

// My posts clear
document.getElementById('my-posts-clear')?.addEventListener('click', function() {
    myPostsMode = false;
    history.replaceState(null, '', 'community.php');
    currentPage = 1;
    loadPosts(1);
});

loadPosts(1);

</script>

    

    
<script src="init.js"></script>
</body>
</html>
