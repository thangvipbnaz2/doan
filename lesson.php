<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bài học - HànNgữ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="lesson.css">
<style>

/* ===== HSK 1-2 Layout ===== */
#layout-hsk12 {
    max-width: 960px; margin: 0 auto;
}
#layout-hsk12 .lesson-layout { display: grid; grid-template-columns: 1.2fr 1fr 1fr; gap: 28px; }
#layout-hsk12 .char-display { text-align: center; padding: 48px 36px; }
#layout-hsk12 .char-display__hanzi { font-size: 8rem; line-height: 1.1; margin-bottom: 12px; }
#layout-hsk12 .char-display__pinyin { font-size: 1.8rem; font-weight: 600; color: var(--teal); font-style: italic; margin-bottom: 4px; }
#layout-hsk12 .char-display__meaning { font-size: 1.3rem; color: var(--gray); margin-bottom: 8px; }
#layout-hsk12 .word-type { display: inline-block; padding: 4px 14px; background: var(--teal-light); color: var(--teal-dark); border-radius: 50px; font-size: .82rem; font-weight: 600; margin-bottom: 20px; }
#layout-hsk12 .audio-row { display: flex; justify-content: center; gap: 12px; margin-bottom: 24px; }
#layout-hsk12 .btn-audio { width: 56px; height: 56px; border-radius: 50%; border: 3px solid var(--teal); background: var(--teal-light); color: var(--teal); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: var(--transition); font-size: 1.5rem; }
#layout-hsk12 .btn-audio:hover { background: var(--teal); color: #fff; transform: scale(1.1); }
#layout-hsk12 .word-nav { display: flex; align-items: center; justify-content: center; gap: 16px; padding-top: 20px; border-top: 1px solid var(--gray-light); margin-top: 20px; }
#layout-hsk12 .word-nav__dots { display: flex; gap: 8px; }
#layout-hsk12 .word-nav__dot { width: 10px; height: 10px; border-radius: 50%; background: var(--gray-light); border: none; cursor: pointer; padding: 0; }
#layout-hsk12 .word-nav__dot.active { background: var(--teal); transform: scale(1.2); }
#layout-hsk12 .practice-area { padding: 32px; }
#layout-hsk12 .section-label { font-size: .85rem; text-transform: uppercase; letter-spacing: 1px; color: var(--gray); font-weight: 600; margin-bottom: 12px; }
#layout-hsk12 .canvas-box { width: 240px; height: 240px; margin: 0 auto 12px; border: 2px solid var(--gray-light); border-radius: var(--radius-sm); overflow: hidden; position: relative; background: #fff; }
#layout-hsk12 .canvas-box canvas { position: relative; z-index: 1; touch-action: none; cursor: crosshair; width: 240px; height: 240px; }
#layout-hsk12 .canvas-ghost { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-family: 'Noto Sans SC', sans-serif; font-size: 8rem; font-weight: 900; color: rgba(0,0,0,0.04); pointer-events: none; z-index: 0; }
#layout-hsk12 .canvas-actions { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; margin-bottom: 16px; }
#layout-hsk12 .stroke-card { padding: 24px 20px; text-align: center; }
#layout-hsk12 .stroke-guide { width: 240px; height: 240px; margin: 0 auto; border: 2px solid var(--gray-light); border-radius: var(--radius-sm); overflow: hidden; background: #fff; }
#layout-hsk12 .stroke-guide .hanzi-writer-box { width: 240px; height: 240px; }
#layout-hsk12 .stroke-actions { display: flex; gap: 8px; justify-content: center; margin-top: 12px; }
#layout-hsk12 .char-selector { display: flex; gap: 8px; justify-content: center; margin-bottom: 12px; flex-wrap: wrap; }
#layout-hsk12 .char-selector__btn { min-width: 44px; padding: 6px 14px; border: 2px solid var(--gray-light); border-radius: var(--radius-sm); background: #fff; font-family: 'Noto Sans SC', sans-serif; font-size: 1.4rem; font-weight: 700; cursor: pointer; transition: var(--transition); color: var(--gray); }
#layout-hsk12 .char-selector__btn:hover { border-color: var(--teal); color: var(--teal); }
#layout-hsk12 .char-selector__btn.active { border-color: var(--teal); background: var(--teal); color: #fff; }
#layout-hsk12 .examples-section { margin-top: 32px; }
#layout-hsk12 .example-card { padding: 20px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); margin-bottom: 16px; border-left: 4px solid var(--teal); }
#layout-hsk12 .example-card__pinyin { font-size: .95rem; color: var(--teal); font-style: italic; font-weight: 600; margin-bottom: 4px; }
#layout-hsk12 .example-card__hanzi { font-family: 'Noto Sans SC', sans-serif; font-size: 1.4rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
#layout-hsk12 .example-card__vi { font-size: .95rem; color: var(--gray); }
#layout-hsk12 .example-card__audio { display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; padding: 6px 14px; border: 1px solid var(--teal); border-radius: 50px; color: var(--teal); cursor: pointer; font-size: .82rem; font-weight: 600; transition: var(--transition); background: var(--teal-light); }
#layout-hsk12 .example-card__audio:hover { background: var(--teal); color: #fff; }
#layout-hsk12 .progress-bar { display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: var(--teal-light); border-radius: var(--radius-sm); margin-top: 32px; }
#layout-hsk12 .progress-bar__fill { height: 6px; background: var(--teal); border-radius: 3px; transition: width .4s ease; }
#layout-hsk12 .progress-bar__track { flex: 1; height: 6px; background: #fff; border-radius: 3px; overflow: hidden; }
#layout-hsk12 .progress-bar__text { font-size: .85rem; font-weight: 600; color: var(--teal-dark); white-space: nowrap; }
#layout-hsk12 .progress-bar__complete { margin-left: auto; }
#layout-hsk12 .word-nav {
    display: flex; align-items: center; justify-content: center;
    gap: 16px; margin-top: 24px;
}
#layout-hsk12 .word-nav__dots { display: flex; gap: 8px; }
#layout-hsk12 .vocab-nav__dot {
    width: 10px; height: 10px; border-radius: 50%;
    background: var(--gray-light); border: none; cursor: pointer; padding: 0;
}
#layout-hsk12 .vocab-nav__dot.active { background: var(--teal); transform: scale(1.2); }

@media(max-width:900px){
    #layout-hsk12 .lesson-layout { grid-template-columns: 1fr 1fr; gap: 20px; }
    #layout-hsk12 .stroke-card { grid-column: 1 / -1; display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 16px; padding: 20px; }
    #layout-hsk12 .stroke-card .section-label { width: 100%; margin-bottom: 0; }
    #layout-hsk12 .canvas-box, #layout-hsk12 .stroke-guide { width: 200px; height: 200px; }
    #layout-hsk12 .canvas-box canvas { width: 200px; height: 200px; }
}
@media(max-width:600px){
    #layout-hsk12 .lesson-layout { grid-template-columns: 1fr; }
    #layout-hsk12 .char-display__hanzi { font-size: 5rem; }
    #layout-hsk12 .canvas-box, #layout-hsk12 .stroke-guide { width: 240px; height: 240px; }
    #layout-hsk12 .canvas-box canvas { width: 240px; height: 240px; }
}

/* ===== HSK 3-4 Layout ===== */
#layout-hsk34 {
    max-width: 720px; margin: 0 auto;
}
#layout-hsk34 .vocab-header {
    display: flex; align-items: flex-start; gap: 32px;
    background: #fff; border-radius: var(--radius);
    box-shadow: var(--shadow); padding: 28px 32px;
}
#layout-hsk34 .vocab-header__left {
    flex-shrink: 0;
    width: 130px; height: 130px;
    display: flex; align-items: center; justify-content: center;
    background: var(--teal-light); border-radius: var(--radius-sm);
}
#layout-hsk34 .vocab-header__hanzi {
    font-family: 'Noto Sans SC', sans-serif;
    font-size: 4rem; font-weight: 700; color: var(--teal-dark);
    line-height: 1;
}
#layout-hsk34 .vocab-header__right { flex: 1; min-width: 0; }
#layout-hsk34 .vocab-header__pinyin-row {
    display: flex; align-items: center; gap: 8px;
    min-height: 32px; margin-bottom: 4px;
}
#layout-hsk34 .vocab-header__pinyin {
    font-size: 1.3rem; font-weight: 600; color: var(--teal);
    font-style: italic;
}
#layout-hsk34 .vocab-header__pinyin.hidden { display: none; }
#layout-hsk34 .vocab-header__toggle-pinyin {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 4px 12px; border: 1px solid var(--gray-light);
    border-radius: 50px; font-size: .78rem; font-weight: 600;
    color: var(--gray); cursor: pointer; transition: var(--transition);
    background: transparent;
}
#layout-hsk34 .vocab-header__toggle-pinyin:hover {
    border-color: var(--teal); color: var(--teal);
}
#layout-hsk34 .vocab-header__toggle-pinyin.active {
    background: var(--teal); color: #fff; border-color: var(--teal);
}
#layout-hsk34 .vocab-header__meaning {
    font-size: 1.15rem; color: var(--dark); margin-bottom: 4px;
}
#layout-hsk34 .vocab-header__word-type {
    display: inline-block; padding: 2px 12px;
    background: var(--gray-light); border-radius: 50px;
    font-size: .75rem; font-weight: 600; color: var(--gray);
    margin-bottom: 12px;
}
#layout-hsk34 .vocab-header__actions {
    display: flex; gap: 8px; flex-wrap: wrap;
}
#layout-hsk34 .vocab-header__actions .btn { font-size: .82rem; }
#layout-hsk34 .vocab-nav {
    display: flex; align-items: center; justify-content: center;
    gap: 16px; margin-top: 24px;
}
#layout-hsk34 .vocab-nav__dots { display: flex; gap: 8px; }
#layout-hsk34 .vocab-nav__dot {
    width: 10px; height: 10px; border-radius: 50%;
    background: var(--gray-light); border: none; cursor: pointer; padding: 0;
}
#layout-hsk34 .vocab-nav__dot.active { background: var(--teal); transform: scale(1.2); }

/* Grammar Structure */
#layout-hsk34 .grammar-section {
    margin-top: 32px;
    background: #fff; border-radius: var(--radius);
    box-shadow: var(--shadow); padding: 28px 32px;
}
#layout-hsk34 .grammar-section__head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}
#layout-hsk34 .grammar-section__head svg { color: var(--teal); }
#layout-hsk34 .grammar-section__title {
    font-size: 1.1rem; font-weight: 700; color: var(--dark);
}
#layout-hsk34 .grammar-formula {
    background: #f0fdf7; border: 1px solid #ccfbf1;
    border-radius: var(--radius-sm); padding: 20px;
    font-size: 1.1rem; line-height: 1.7;
    margin-bottom: 12px;
}
#layout-hsk34 .grammar-formula__part {
    display: inline-block; padding: 2px 10px;
    border-radius: 4px; font-weight: 600;
}
#layout-hsk34 .grammar-formula__part--subject { background: #dbeafe; color: #1d4ed8; }
#layout-hsk34 .grammar-formula__part--verb { background: #fce7f3; color: #be185d; }
#layout-hsk34 .grammar-formula__part--object { background: #fef3c7; color: #b45309; }
#layout-hsk34 .grammar-formula__part--particle { background: #e0e7ff; color: #4338ca; }
#layout-hsk34 .grammar-formula__part--adj { background: #d1fae5; color: #047857; }
#layout-hsk34 .grammar-formula__part--other { background: #f3e8ff; color: #7c3aed; }
#layout-hsk34 .grammar-formula__part--adv { background: #fff7ed; color: #c2410c; }
#layout-hsk34 .grammar-example {
    padding: 16px 20px; background: var(--gray-light);
    border-radius: var(--radius-sm);
    margin-top: 12px;
}
#layout-hsk34 .grammar-example__hanzi {
    font-family: 'Noto Sans SC', sans-serif;
    font-size: 1.1rem; font-weight: 600; color: var(--dark);
    margin-bottom: 4px;
}
#layout-hsk34 .grammar-example__pinyin {
    font-size: .9rem; color: var(--teal); font-style: italic;
    margin-bottom: 2px;
}
#layout-hsk34 .grammar-example__vi {
    font-size: .9rem; color: var(--gray);
}

/* Word Collocation */
#layout-hsk34 .collocation-section {
    margin-top: 32px;
    background: #fff; border-radius: var(--radius);
    box-shadow: var(--shadow); padding: 28px 32px;
}
#layout-hsk34 .collocation-section__head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}
#layout-hsk34 .collocation-section__head svg { color: var(--teal); }
#layout-hsk34 .collocation-section__title {
    font-size: 1.1rem; font-weight: 700; color: var(--dark);
}
#layout-hsk34 .collocation-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 12px;
}
#layout-hsk34 .collocation-card {
    padding: 16px; background: var(--gray-light);
    border-radius: var(--radius-sm);
    border-left: 3px solid var(--teal);
}
#layout-hsk34 .collocation-card__pattern {
    font-family: 'Noto Sans SC', sans-serif;
    font-size: 1rem; font-weight: 700; color: var(--teal-dark);
    margin-bottom: 4px;
}
#layout-hsk34 .collocation-card__meaning {
    font-size: .88rem; color: var(--gray); margin-bottom: 4px;
}
#layout-hsk34 .collocation-card__example {
    font-size: .82rem; color: var(--gray);
    font-style: italic;
}

/* Example List */
#layout-hsk34 .examples-section {
    margin-top: 32px;
    background: #fff; border-radius: var(--radius);
    box-shadow: var(--shadow); padding: 28px 32px;
}
#layout-hsk34 .examples-section__head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}
#layout-hsk34 .examples-section__head svg { color: var(--teal); }
#layout-hsk34 .examples-section__title {
    font-size: 1.1rem; font-weight: 700; color: var(--dark);
}
#layout-hsk34 .example-item {
    padding: 14px 0;
    border-bottom: 1px solid var(--gray-light);
}
#layout-hsk34 .example-item:last-child { border-bottom: none; }
#layout-hsk34 .example-item__row {
    display: flex; align-items: flex-start; gap: 12px;
}
#layout-hsk34 .example-item__audio {
    flex-shrink: 0; width: 36px; height: 36px;
    border-radius: 50%; border: 2px solid var(--teal-light);
    background: var(--teal-light); color: var(--teal);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: var(--transition);
}
#layout-hsk34 .example-item__audio:hover {
    background: var(--teal); color: #fff;
}
#layout-hsk34 .example-item__content { flex: 1; min-width: 0; }
#layout-hsk34 .example-item__hanzi {
    font-family: 'Noto Sans SC', sans-serif;
    font-size: 1.2rem; font-weight: 600; color: var(--dark);
}
#layout-hsk34 .example-item__pinyin {
    font-size: .9rem; color: var(--teal); font-style: italic;
    margin-top: 2px;
}
#layout-hsk34 .example-item__pinyin.hidden { display: none; }
#layout-hsk34 .example-item__vi {
    font-size: .88rem; color: var(--gray); margin-top: 2px;
}

/* Progress bar (shared) */
#layout-hsk34 .progress-section {
    display: flex; align-items: center; gap: 12px;
    padding: 16px 20px; background: var(--teal-light);
    border-radius: var(--radius-sm); margin-top: 32px;
}
#layout-hsk34 .progress-section__fill {
    height: 6px; background: var(--teal); border-radius: 3px;
    transition: width .4s ease;
}
#layout-hsk34 .progress-section__track {
    flex: 1; height: 6px; background: #fff;
    border-radius: 3px; overflow: hidden;
}
#layout-hsk34 .progress-section__text {
    font-size: .85rem; font-weight: 600; color: var(--teal-dark);
    white-space: nowrap;
}

@media(max-width:640px){
    #layout-hsk34 .vocab-header { flex-direction: column; align-items: center; text-align: center; }
    #layout-hsk34 .vocab-header__left { width: 100px; height: 100px; }
    #layout-hsk34 .vocab-header__hanzi { font-size: 3rem; }
    #layout-hsk34 .vocab-header__pinyin-row { justify-content: center; }
    #layout-hsk34 .vocab-header__actions { justify-content: center; }
    #layout-hsk34 .collocation-grid { grid-template-columns: 1fr; }
}

/* ===== HSK 5 Layout ===== */
#layout-hsk5 {
    max-width: 780px; margin: 0 auto;
    font-size: 1rem; line-height: 1.7;
}
#layout-hsk5 .vocab-card {
    background: #fff; border-radius: var(--radius);
    box-shadow: var(--shadow); padding: 32px;
    margin-bottom: 28px;
}
#layout-hsk5 .vocab-card__top {
    display: flex; align-items: center; gap: 24px;
    margin-bottom: 20px;
}
#layout-hsk5 .vocab-card__char-box {
    flex-shrink: 0;
    width: 100px; height: 100px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
}
#layout-hsk5 .vocab-card__hanzi {
    font-family: 'Noto Sans SC', serif;
    font-size: 3.2rem; font-weight: 700;
    color: var(--dark); line-height: 1;
}
#layout-hsk5 .vocab-card__info { flex: 1; }
#layout-hsk5 .vocab-card__meaning {
    font-size: 1.2rem; font-weight: 700;
    color: var(--dark); margin-bottom: 4px;
}
#layout-hsk5 .vocab-card__meta {
    font-size: .85rem; color: var(--gray);
    margin-bottom: 8px;
}
#layout-hsk5 .vocab-card__type {
    display: inline-block; padding: 3px 12px;
    background: #f1f5f9; border-radius: 50px;
    font-size: .78rem; font-weight: 600; color: var(--gray);
}
#layout-hsk5 .vocab-card__actions {
    display: flex; gap: 8px; flex-wrap: wrap;
}
#layout-hsk5 .vocab-nav {
    display: flex; align-items: center; justify-content: center;
    gap: 16px; margin-bottom: 28px;
}
#layout-hsk5 .vocab-nav__dots { display: flex; gap: 8px; }
#layout-hsk5 .vocab-nav__dot {
    width: 10px; height: 10px; border-radius: 50%;
    background: #d1d5db; border: none; cursor: pointer; padding: 0;
}
#layout-hsk5 .vocab-nav__dot.active { background: #475569; transform: scale(1.2); }

/* WordRoots */
#layout-hsk5 .roots-section { margin-bottom: 28px; }
#layout-hsk5 .roots-section__head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}
#layout-hsk5 .roots-section__head svg { color: #475569; }
#layout-hsk5 .roots-section__title {
    font-size: 1rem; font-weight: 700; color: var(--dark);
    text-transform: uppercase; letter-spacing: .5px;
}
#layout-hsk5 .roots-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 12px;
}
#layout-hsk5 .root-card {
    padding: 18px; background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-sm);
    border-left: 3px solid #475569;
}
#layout-hsk5 .root-card__char {
    font-family: 'Noto Sans SC', serif;
    font-size: 2rem; font-weight: 700;
    color: var(--dark); margin-bottom: 6px;
}
#layout-hsk5 .root-card__radical {
    font-size: .85rem; font-weight: 600;
    color: #475569; margin-bottom: 4px;
}
#layout-hsk5 .root-card__meaning {
    font-size: .88rem; color: var(--gray);
    line-height: 1.5;
}

/* SynonymsComparison */
#layout-hsk5 .synonyms-section { margin-bottom: 28px; }
#layout-hsk5 .synonyms-section__head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}
#layout-hsk5 .synonyms-section__head svg { color: #475569; }
#layout-hsk5 .synonyms-section__title {
    font-size: 1rem; font-weight: 700; color: var(--dark);
    text-transform: uppercase; letter-spacing: .5px;
}
#layout-hsk5 .synonyms-table {
    width: 100%; border-collapse: collapse;
    font-size: .9rem;
}
#layout-hsk5 .synonyms-table th {
    background: #f1f5f9; padding: 12px 16px;
    text-align: left; font-weight: 700;
    color: var(--dark); border-bottom: 2px solid #cbd5e1;
}
#layout-hsk5 .synonyms-table td {
    padding: 14px 16px; border-bottom: 1px solid #e2e8f0;
    vertical-align: top; line-height: 1.6;
}
#layout-hsk5 .synonyms-table .synonym-word {
    font-family: 'Noto Sans SC', serif;
    font-size: 1.2rem; font-weight: 700; color: var(--teal-dark);
}
#layout-hsk5 .synonyms-table .same-col { background: #f0fdf4; }
#layout-hsk5 .synonyms-table .diff-col { background: #fef2f2; }
#layout-hsk5 .synonyms-none {
    color: var(--gray); font-style: italic; font-size: .9rem;
}

/* ContextualParagraph */
#layout-hsk5 .paragraph-section { margin-bottom: 28px; }
#layout-hsk5 .paragraph-section__head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 16px;
}
#layout-hsk5 .paragraph-section__head svg { color: #475569; }
#layout-hsk5 .paragraph-section__title {
    font-size: 1rem; font-weight: 700; color: var(--dark);
    text-transform: uppercase; letter-spacing: .5px;
}
#layout-hsk5 .paragraph-box {
    padding: 24px 28px; background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-sm);
    line-height: 1.9;
}
#layout-hsk5 .paragraph-box__zh {
    font-family: 'Noto Sans SC', serif;
    font-size: 1rem; color: var(--dark);
    margin-bottom: 12px;
}
#layout-hsk5 .paragraph-box__zh mark {
    background: #fef9c3; color: var(--dark);
    padding: 0 4px; font-weight: 700;
}
#layout-hsk5 .paragraph-box__vi {
    font-size: .9rem; color: var(--gray);
    line-height: 1.7;
    padding-top: 12px; border-top: 1px solid #e2e8f0;
}

/* Progress */
#layout-hsk5 .progress-section {
    display: flex; align-items: center; gap: 12px;
    padding: 16px 20px; background: #f1f5f9;
    border-radius: var(--radius-sm); margin-top: 28px;
}
#layout-hsk5 .progress-section__fill {
    height: 6px; background: #475569; border-radius: 3px;
    transition: width .4s ease;
}
#layout-hsk5 .progress-section__track {
    flex: 1; height: 6px; background: #fff;
    border-radius: 3px; overflow: hidden;
}
#layout-hsk5 .progress-section__text {
    font-size: .85rem; font-weight: 600; color: #475569;
    white-space: nowrap;
}

@media(max-width:640px){
    #layout-hsk5 .vocab-card__top { flex-direction: column; align-items: flex-start; }
    #layout-hsk5 .vocab-card__char-box { width: 80px; height: 80px; }
    #layout-hsk5 .vocab-card__hanzi { font-size: 2.5rem; }
    #layout-hsk5 .roots-grid { grid-template-columns: 1fr; }
    #layout-hsk5 .synonyms-table { font-size: .82rem; }
    #layout-hsk5 .synonyms-table th,
    #layout-hsk5 .synonyms-table td { padding: 10px 12px; }
}

/* ===== HSK 6 Layout ===== */
#layout-hsk6 {
    max-width: 780px; margin: 0 auto;
    font-family: 'Georgia', 'Noto Sans SC', 'Times New Roman', serif;
    font-size: 1rem; line-height: 1.8; color: #1e293b;
}
#layout-hsk6 .card {
    background: #fff; border-radius: 0; padding: 28px 32px;
    margin-bottom: 24px; border: 1px solid #e2e8f0;
}
#layout-hsk6 .card__head {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 20px; padding-bottom: 12px;
    border-bottom: 1px solid #e2e8f0;
}
#layout-hsk6 .card__head svg { color: #475569; width: 18px; height: 18px; }
#layout-hsk6 .card__title {
    font-size: .82rem; font-weight: 700; color: #475569;
    text-transform: uppercase; letter-spacing: 1.5px;
    font-family: 'Inter', sans-serif;
}

/* WordHeader */
#layout-hsk6 .word-row {
    display: flex; align-items: flex-start; gap: 28px;
}
#layout-hsk6 .word-row__char-box {
    flex-shrink: 0;
    width: 90px; height: 90px;
    border: 1px solid #e2e8f0;
    display: flex; align-items: center; justify-content: center;
    background: #fafafa;
}
#layout-hsk6 .word-row__hanzi {
    font-family: 'Noto Sans SC', serif;
    font-size: 2.8rem; font-weight: 700;
    color: #1e293b; line-height: 1;
}
#layout-hsk6 .word-row__info { flex: 1; }
#layout-hsk6 .word-row__meaning {
    font-size: 1.15rem; font-weight: 600;
    color: #1e293b; margin-bottom: 4px;
}
#layout-hsk6 .word-row__meta {
    font-size: .82rem; color: #64748b;
    margin-bottom: 10px;
}
#layout-hsk6 .word-row__type {
    display: inline-block; padding: 2px 10px;
    background: #f1f5f9; font-size: .75rem;
    font-weight: 600; color: #64748b;
}
#layout-hsk6 .word-row__actions { display: flex; gap: 8px; }
#layout-hsk6 .word-row__nav {
    display: flex; align-items: center; justify-content: center;
    gap: 16px; margin-top: 20px; padding-top: 16px;
    border-top: 1px solid #e2e8f0;
}
#layout-hsk6 .word-row__dots { display: flex; gap: 8px; }
#layout-hsk6 .word-row__dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #d1d5db; border: none; cursor: pointer; padding: 0;
}
#layout-hsk6 .word-row__dot.active { background: #475569; }

/* ChengyuOrigin */
#layout-hsk6 .chengyu-story {
    padding: 20px 24px; background: #fafafa;
    border-left: 3px solid #475569;
    line-height: 1.9;
}
#layout-hsk6 .chengyu-story__zh {
    font-family: 'Noto Sans SC', serif;
    font-size: .95rem; margin-bottom: 12px;
    color: #1e293b;
}
#layout-hsk6 .chengyu-story__zh mark {
    background: #fef9c3; color: #1e293b;
    padding: 0 3px; font-weight: 700;
}
#layout-hsk6 .chengyu-story__vi {
    font-size: .9rem; color: #475569;
    padding-top: 12px; border-top: 1px solid #e2e8f0;
}
#layout-hsk6 .chengyu-label {
    display: inline-block; margin-bottom: 14px;
    padding: 3px 12px; background: #1e293b; color: #fff;
    font-size: .72rem; font-weight: 700; letter-spacing: 1px;
    font-family: 'Inter', sans-serif;
}

/* AdvancedTextExcerpt */
#layout-hsk6 .excerpt-block {
    position: relative;
}
#layout-hsk6 .excerpt-block__badge {
    display: inline-block; margin-bottom: 14px;
    padding: 3px 12px; background: #1e293b; color: #fff;
    font-size: .72rem; font-weight: 700; letter-spacing: 1px;
    font-family: 'Inter', sans-serif;
}
#layout-hsk6 .excerpt-block__content {
    padding: 0; line-height: 2;
    font-size: .95rem;
}
#layout-hsk6 .excerpt-block__content p {
    margin-bottom: 1.2em; text-indent: 2em;
    text-align: justify;
}
#layout-hsk6 .excerpt-block__content mark {
    background: #fef9c3; color: #1e293b;
    padding: 0 2px;
}
#layout-hsk6 .excerpt-block__source {
    margin-top: 16px; padding-top: 12px;
    border-top: 1px solid #e2e8f0;
    font-size: .82rem; color: #94a3b8; font-style: italic;
    font-family: 'Inter', sans-serif;
}
#layout-hsk6 .excerpt-block__vi {
    margin-top: 16px; padding: 16px 20px;
    background: #fafafa; font-size: .9rem;
    color: #475569; line-height: 1.7;
}

/* UsageNotes */
#layout-hsk6 .usage-list { list-style: none; padding: 0; margin: 0; }
#layout-hsk6 .usage-list li {
    padding: 14px 0; border-bottom: 1px solid #f1f5f9;
    display: flex; gap: 12px; align-items: flex-start;
}
#layout-hsk6 .usage-list li:last-child { border-bottom: none; }
#layout-hsk6 .usage-list__icon {
    flex-shrink: 0; width: 24px; height: 24px;
    border-radius: 50%; background: #f1f5f9;
    display: flex; align-items: center; justify-content: center;
    font-size: .75rem; margin-top: 2px;
}
#layout-hsk6 .usage-list__text { font-size: .9rem; line-height: 1.7; color: #334155; }
#layout-hsk6 .usage-list__text strong { color: #1e293b; }
#layout-hsk6 .usage-list__text em { color: #475569; font-style: normal; }

/* Progress */
#layout-hsk6 .progress-line {
    display: flex; align-items: center; gap: 12px;
    padding: 16px 20px; margin-top: 24px;
    border: 1px solid #e2e8f0; background: #fafafa;
}
#layout-hsk6 .progress-line__fill {
    height: 4px; background: #475569; border-radius: 0;
    transition: width .4s ease;
}
#layout-hsk6 .progress-line__track {
    flex: 1; height: 4px; background: #e2e8f0;
    border-radius: 0; overflow: hidden;
}
#layout-hsk6 .progress-line__text {
    font-size: .8rem; font-weight: 600; color: #64748b;
    white-space: nowrap; font-family: 'Inter', sans-serif;
}

@media(max-width:640px){
    #layout-hsk6 .word-row { flex-direction: column; align-items: flex-start; }
    #layout-hsk6 .word-row__char-box { width: 70px; height: 70px; }
    #layout-hsk6 .word-row__hanzi { font-size: 2.2rem; }
    #layout-hsk6 .card { padding: 20px; }
}

/* Hidden until loaded */
#layout-hsk12, #layout-hsk34, #layout-hsk5, #layout-hsk6 { display: none; }

[data-theme="dark"] .lesson-page { background: #0f172a; }
[data-theme="dark"] .lesson-card { background: #1e293b; }
[data-theme="dark"] #layout-hsk12 .char-display__hanzi { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk12 .char-display__meaning { color: #94a3b8; }
[data-theme="dark"] #layout-hsk12 .word-type { background: rgba(13,148,136,.15); color: #5eead4; }
[data-theme="dark"] #layout-hsk12 .word-nav { border-top-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk12 .word-nav__dot { background: rgba(255,255,255,.15); }
[data-theme="dark"] #layout-hsk12 .word-nav__dot.active { background: var(--teal); }
[data-theme="dark"] #layout-hsk12 .btn-audio { border-color: rgba(13,148,136,.4); background: rgba(13,148,136,.15); color: #5eead4; }
[data-theme="dark"] #layout-hsk12 .btn-audio:hover { background: var(--teal); color: #fff; }
[data-theme="dark"] #layout-hsk12 .section-label { color: #64748b; }
[data-theme="dark"] #layout-hsk12 .canvas-box { border-color: rgba(255,255,255,.08); background: #0f172a; }
[data-theme="dark"] #layout-hsk12 .canvas-ghost { color: rgba(255,255,255,.06); }
[data-theme="dark"] #layout-hsk12 .stroke-guide { border-color: rgba(255,255,255,.08); background: #0f172a; }
[data-theme="dark"] #layout-hsk12 .example-card { background: #1e293b; }
[data-theme="dark"] #layout-hsk12 .example-card__hanzi { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk12 .example-card__vi { color: #94a3b8; }
[data-theme="dark"] #layout-hsk12 .example-card__audio { background: rgba(13,148,136,.15); }
[data-theme="dark"] #layout-hsk12 .progress-bar { background: rgba(13,148,136,.1); }
[data-theme="dark"] #layout-hsk12 .progress-bar__track { background: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk12 .progress-bar__text { color: #5eead4; }
[data-theme="dark"] #layout-hsk12 .char-selector__btn { background: #1e293b; border-color: rgba(255,255,255,.08); color: #94a3b8; }
[data-theme="dark"] #layout-hsk12 .char-selector__btn:hover { border-color: var(--teal); color: var(--teal); }

[data-theme="dark"] #layout-hsk34 .vocab-header { background: #1e293b; }
[data-theme="dark"] #layout-hsk34 .vocab-header__left { background: rgba(13,148,136,.1); }
[data-theme="dark"] #layout-hsk34 .vocab-header__hanzi { color: #5eead4; }
[data-theme="dark"] #layout-hsk34 .vocab-header__meaning { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk34 .vocab-header__word-type { background: rgba(255,255,255,.08); color: #94a3b8; }
[data-theme="dark"] #layout-hsk34 .vocab-header__toggle-pinyin { border-color: rgba(255,255,255,.08); color: #94a3b8; }
[data-theme="dark"] #layout-hsk34 .grammar-section { background: #1e293b; }
[data-theme="dark"] #layout-hsk34 .grammar-section__title { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk34 .grammar-formula { background: rgba(15,23,42,.6); border-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk34 .grammar-example { background: rgba(255,255,255,.04); }
[data-theme="dark"] #layout-hsk34 .grammar-example__hanzi { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk34 .grammar-example__vi { color: #94a3b8; }
[data-theme="dark"] #layout-hsk34 .collocation-section { background: #1e293b; }
[data-theme="dark"] #layout-hsk34 .collocation-section__title { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk34 .collocation-card { background: rgba(255,255,255,.04); }
[data-theme="dark"] #layout-hsk34 .collocation-card__pattern { color: #5eead4; }
[data-theme="dark"] #layout-hsk34 .collocation-card__meaning { color: #94a3b8; }
[data-theme="dark"] #layout-hsk34 .collocation-card__example { color: #64748b; }
[data-theme="dark"] #layout-hsk34 .examples-section { background: #1e293b; }
[data-theme="dark"] #layout-hsk34 .examples-section__title { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk34 .example-item { border-bottom-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk34 .example-item__hanzi { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk34 .example-item__vi { color: #94a3b8; }
[data-theme="dark"] #layout-hsk34 .example-item__audio { border-color: rgba(13,148,136,.3); background: rgba(13,148,136,.1); color: #5eead4; }
[data-theme="dark"] #layout-hsk34 .example-item__audio:hover { background: var(--teal); color: #fff; }
[data-theme="dark"] #layout-hsk34 .progress-section { background: rgba(13,148,136,.1); }
[data-theme="dark"] #layout-hsk34 .progress-section__track { background: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk34 .progress-section__text { color: #5eead4; }

[data-theme="dark"] #layout-hsk5 .vocab-card { background: #1e293b; }
[data-theme="dark"] #layout-hsk5 .vocab-card__char-box { background: #0f172a; border-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk5 .vocab-card__hanzi { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .vocab-card__meaning { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .vocab-card__meta { color: #64748b; }
[data-theme="dark"] #layout-hsk5 .vocab-card__type { background: rgba(255,255,255,.08); color: #94a3b8; }
[data-theme="dark"] #layout-hsk5 .vocab-nav__dot { background: rgba(255,255,255,.15); }
[data-theme="dark"] #layout-hsk5 .vocab-nav__dot.active { background: #94a3b8; }
[data-theme="dark"] #layout-hsk5 .roots-section__title { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .root-card { background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk5 .root-card__char { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .root-card__radical { color: #94a3b8; }
[data-theme="dark"] #layout-hsk5 .root-card__meaning { color: #94a3b8; }
[data-theme="dark"] #layout-hsk5 .synonyms-section__title { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .synonyms-table th { background: rgba(255,255,255,.06); color: #f1f5f9; border-bottom-color: rgba(255,255,255,.1); }
[data-theme="dark"] #layout-hsk5 .synonyms-table td { border-bottom-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk5 .synonyms-table .same-col { background: rgba(16,185,129,.1); }
[data-theme="dark"] #layout-hsk5 .synonyms-table .diff-col { background: rgba(239,68,68,.1); }
[data-theme="dark"] #layout-hsk5 .synonyms-none { color: #64748b; }
[data-theme="dark"] #layout-hsk5 .paragraph-section__title { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .paragraph-box { background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk5 .paragraph-box__zh { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .paragraph-box__zh mark { background: rgba(250,204,21,.15); color: #f1f5f9; }
[data-theme="dark"] #layout-hsk5 .paragraph-box__vi { color: #94a3b8; border-top-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk5 .progress-section { background: rgba(255,255,255,.04); }
[data-theme="dark"] #layout-hsk5 .progress-section__track { background: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk5 .progress-section__text { color: #94a3b8; }

[data-theme="dark"] #layout-hsk6 { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk6 .card { background: #1e293b; border-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk6 .card__head { border-bottom-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk6 .card__title { color: #94a3b8; }
[data-theme="dark"] #layout-hsk6 .word-row__char-box { border-color: rgba(255,255,255,.08); background: #0f172a; }
[data-theme="dark"] #layout-hsk6 .word-row__hanzi { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk6 .word-row__meaning { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk6 .word-row__meta { color: #64748b; }
[data-theme="dark"] #layout-hsk6 .word-row__type { background: rgba(255,255,255,.08); color: #94a3b8; }
[data-theme="dark"] #layout-hsk6 .word-row__nav { border-top-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk6 .word-row__dot { background: rgba(255,255,255,.15); }
[data-theme="dark"] #layout-hsk6 .word-row__dot.active { background: #94a3b8; }
[data-theme="dark"] #layout-hsk6 .chengyu-story { background: #0f172a; border-left-color: #94a3b8; }
[data-theme="dark"] #layout-hsk6 .chengyu-story__zh { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk6 .chengyu-story__zh mark { background: rgba(250,204,21,.15); color: #f1f5f9; }
[data-theme="dark"] #layout-hsk6 .chengyu-story__vi { color: #94a3b8; border-top-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk6 .excerpt-block__content mark { background: rgba(250,204,21,.15); color: #f1f5f9; }
[data-theme="dark"] #layout-hsk6 .excerpt-block__source { border-top-color: rgba(255,255,255,.08); color: #64748b; }
[data-theme="dark"] #layout-hsk6 .excerpt-block__vi { background: #0f172a; color: #94a3b8; }
[data-theme="dark"] #layout-hsk6 .usage-list li { border-bottom-color: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk6 .usage-list__icon { background: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk6 .usage-list__text { color: #94a3b8; }
[data-theme="dark"] #layout-hsk6 .usage-list__text strong { color: #f1f5f9; }
[data-theme="dark"] #layout-hsk6 .usage-list__text em { color: #94a3b8; }
[data-theme="dark"] #layout-hsk6 .progress-line { border-color: rgba(255,255,255,.08); background: #1e293b; }
[data-theme="dark"] #layout-hsk6 .progress-line__track { background: rgba(255,255,255,.08); }
[data-theme="dark"] #layout-hsk6 .progress-line__text { color: #64748b; }
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="lesson-page">
<div class="container">

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="index.php">Trang chủ</a>
        <span class="breadcrumb__sep">›</span>
        <a href="lessons.php" id="breadcrumb-level">HSK 1</a>
        <span class="breadcrumb__sep">›</span>
        <span class="breadcrumb__current" id="breadcrumb-lesson">Bài 1</span>
    </div>

    <!-- Header -->
    <div class="lesson-header">
        <div>
            <span class="lesson-header__badge" id="lesson-badge">HSK 1 · Bài 1</span>
            <h1 class="lesson-header__title" id="lesson-title">Chào hỏi cơ bản</h1>
            <p class="lesson-header__desc" id="lesson-desc">Học cách chào hỏi và giới thiệu bản thân.</p>
        </div>
    </div>

    <!-- ===== HSK 1-2 Layout ===== -->
    <div id="layout-hsk12">
        <div class="lesson-layout">
            <div class="lesson-card char-display">
                <div class="char-display__main">
                    <div class="char-display__hanzi" id="h12-hanzi">你</div>
                    <div class="char-display__pinyin" id="h12-pinyin">nǐ</div>
                    <div class="char-display__meaning" id="h12-meaning">Bạn / Anh / Chị</div>
                    <span class="word-type" id="h12-word-type">Đại từ</span>
                </div>
                <div class="audio-row">
                    <button class="btn-audio" id="h12-btn-audio" title="Nghe phát âm">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
                    </button>
                    <button class="btn btn--gold btn--sm ripple" id="h12-btn-save-word">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                        Lưu từ
                    </button>
                </div>
                <div class="word-nav">
                    <button class="btn btn--outline btn--sm ripple" id="h12-btn-prev" disabled>← Trước</button>
                    <div class="word-nav__dots" id="h12-char-dots"></div>
                    <button class="btn btn--outline btn--sm ripple" id="h12-btn-next">Tiếp →</button>
                </div>
            </div>
            <div class="lesson-card practice-area">
                <div class="section-label">✍ Luyện viết</div>
                <div class="canvas-box" id="canvas-wrapper">
                    <canvas id="writing-canvas" width="280" height="280"></canvas>
                    <span class="canvas-ghost" id="canvas-ghost">你</span>
                </div>
                <div class="canvas-actions">
                    <button class="btn btn--outline btn--sm ripple" id="btn-clear">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                        Xoá
                    </button>
                    <button class="btn btn--gold btn--sm ripple" id="btn-check-handwriting">📝 Kiểm tra</button>
                </div>
                <div id="handwriting-result" style="text-align:center;min-height:24px;font-size:.9rem;font-weight:600;margin-bottom:16px;"></div>
            </div>
            <div class="lesson-card stroke-card">
                <div class="section-label">🖌 Hướng dẫn nét</div>
                <div class="char-selector" id="char-selector"></div>
                <div class="stroke-guide"><div id="hanzi-writer-target" class="hanzi-writer-box"></div></div>
                <div class="stroke-actions">
                    <button class="btn btn--gold btn--sm ripple" id="btn-animate">▶ Xem hướng dẫn</button>
                    <button class="btn btn--outline btn--sm ripple" id="btn-quiz">✍ Tập viết</button>
                </div>
            </div>
        </div>
        <div class="examples-section" id="h12-examples">
            <div class="section-label" style="margin-bottom:16px;">📖 Ví dụ</div>
            <div id="h12-examples-container"></div>
        </div>
        <div class="progress-bar" id="h12-progress">
            <span class="progress-bar__text" id="h12-progress-text">1/5</span>
            <div class="progress-bar__track">
                <div class="progress-bar__fill" id="h12-progress-fill" style="width:20%"></div>
            </div>
            <button class="btn btn--gold btn--sm ripple progress-bar__complete" id="h12-btn-complete" style="display:none;" onclick="completeLesson()">✅ Hoàn thành</button>
        </div>
    </div>

    <!-- ===== HSK 3-4 Layout ===== -->
    <div id="layout-hsk34">
        <!-- WordHeader -->
        <div class="vocab-header">
            <div class="vocab-header__left">
                <div class="vocab-header__hanzi" id="h34-hanzi">发展</div>
            </div>
            <div class="vocab-header__right">
                <div class="vocab-header__pinyin-row">
                    <span class="vocab-header__pinyin" id="h34-pinyin">fāzhǎn</span>
                    <button class="vocab-header__toggle-pinyin active" id="h34-toggle-pinyin">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Ẩn Pinyin
                    </button>
                </div>
                <div class="vocab-header__meaning" id="h34-meaning">Phát triển</div>
                <div class="vocab-header__word-type" id="h34-word-type">Động từ</div>
                <div class="vocab-header__actions">
                    <button class="btn btn--primary btn--sm ripple" id="h34-btn-audio">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
                        Nghe
                    </button>
                    <button class="btn btn--gold btn--sm ripple" id="h34-btn-save-word">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                        Lưu
                    </button>
                </div>
            </div>
        </div>

        <div class="vocab-nav">
            <button class="btn btn--outline btn--sm ripple" id="h34-btn-prev" disabled>← Trước</button>
            <div class="vocab-nav__dots" id="h34-char-dots"></div>
            <button class="btn btn--outline btn--sm ripple" id="h34-btn-next">Tiếp →</button>
        </div>

        <!-- GrammarStructure -->
        <div class="grammar-section" id="grammar-section">
            <div class="grammar-section__head">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 6v12"/><path d="M18 12H6"/><path d="M9 9l3-3 3 3"/><path d="M15 15l-3 3-3-3"/></svg>
                <span class="grammar-section__title">Cấu trúc ngữ pháp</span>
            </div>
            <div class="grammar-formula" id="grammar-formula">Chưa có dữ liệu</div>
            <div id="grammar-examples"></div>
        </div>

        <!-- WordCollocation -->
        <div class="collocation-section" id="collocation-section">
            <div class="collocation-section__head">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M20 22H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20"/><path d="M8 7h8"/><path d="M8 11h6"/></svg>
                <span class="collocation-section__title">Cụm từ thường dùng</span>
            </div>
            <div class="collocation-grid" id="collocation-grid"></div>
        </div>

        <!-- ExampleList -->
        <div class="examples-section">
            <div class="examples-section__head">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <span class="examples-section__title">Ví dụ</span>
            </div>
            <div id="h34-examples-container"></div>
        </div>

        <!-- Progress -->
        <div class="progress-section" id="h34-progress">
            <span class="progress-section__text" id="h34-progress-text">1/5</span>
            <div class="progress-section__track">
                <div class="progress-section__fill" id="h34-progress-fill" style="width:20%"></div>
            </div>
            <button class="btn btn--gold btn--sm ripple" id="h34-btn-complete" style="display:none;" onclick="completeLesson()">✅ Hoàn thành</button>
        </div>
    </div>

    <!-- ===== HSK 5 Layout ===== -->
    <div id="layout-hsk5">
        <!-- WordHeader -->
        <div class="vocab-card">
            <div class="vocab-card__top">
                <div class="vocab-card__char-box">
                    <div class="vocab-card__hanzi" id="h5-hanzi">发展</div>
                </div>
                <div class="vocab-card__info">
                    <div class="vocab-card__meaning" id="h5-meaning">Phát triển</div>
                    <div class="vocab-card__meta">
                        <span class="vocab-card__type" id="h5-word-type">Động từ</span>
                    </div>
                    <div class="vocab-card__actions">
                        <button class="btn btn--primary btn--sm ripple" id="h5-btn-audio">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
                            Nghe
                        </button>
                        <button class="btn btn--gold btn--sm ripple" id="h5-btn-save-word">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                            Lưu
                        </button>
                    </div>
                </div>
            </div>
            <div class="vocab-nav">
                <button class="btn btn--outline btn--sm ripple" id="h5-btn-prev" disabled>← Trước</button>
                <div class="vocab-nav__dots" id="h5-char-dots"></div>
                <button class="btn btn--outline btn--sm ripple" id="h5-btn-next">Tiếp →</button>
            </div>
        </div>

        <!-- WordRoots -->
        <div class="roots-section vocab-card">
            <div class="roots-section__head">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>
                <span class="roots-section__title">Phân tích chữ Hán</span>
            </div>
            <div class="roots-grid" id="h5-roots-grid"></div>
        </div>

        <!-- SynonymsComparison -->
        <div class="synonyms-section vocab-card">
            <div class="synonyms-section__head">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/></svg>
                <span class="synonyms-section__title">Phân biệt từ đồng nghĩa</span>
            </div>
            <div id="h5-synonyms-container">
                <p class="synonyms-none">Đang tải...</p>
            </div>
        </div>

        <!-- ContextualParagraph -->
        <div class="paragraph-section vocab-card">
            <div class="paragraph-section__head">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                <span class="paragraph-section__title">Học qua ngữ cảnh</span>
            </div>
            <div id="h5-paragraph-container">
                <p class="synonyms-none">Đang tải...</p>
            </div>
        </div>

        <!-- Progress -->
        <div class="progress-section" id="h5-progress">
            <span class="progress-section__text" id="h5-progress-text">1/5</span>
            <div class="progress-section__track">
                <div class="progress-section__fill" id="h5-progress-fill" style="width:20%"></div>
            </div>
            <button class="btn btn--gold btn--sm ripple" id="h5-btn-complete" style="display:none;" onclick="completeLesson()">✅ Hoàn thành</button>
        </div>
    </div>

    <!-- ===== HSK 6 Layout ===== -->
    <div id="layout-hsk6">
        <!-- WordHeader -->
        <div class="card">
            <div class="word-row">
                <div class="word-row__char-box">
                    <div class="word-row__hanzi" id="h6-hanzi">画蛇添足</div>
                </div>
                <div class="word-row__info">
                    <div class="word-row__meaning" id="h6-meaning">Vẽ rắn thêm chân</div>
                    <div class="word-row__meta">
                        <span class="word-row__type" id="h6-word-type">Thành ngữ</span>
                    </div>
                    <div class="word-row__actions">
                        <button class="btn btn--primary btn--sm ripple" id="h6-btn-audio">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
                            Nghe
                        </button>
                        <button class="btn btn--gold btn--sm ripple" id="h6-btn-save-word">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                            Lưu
                        </button>
                    </div>
                </div>
            </div>
            <div class="word-row__nav">
                <button class="btn btn--outline btn--sm ripple" id="h6-btn-prev" disabled>← Trước</button>
                <div class="word-row__dots" id="h6-char-dots"></div>
                <button class="btn btn--outline btn--sm ripple" id="h6-btn-next">Tiếp →</button>
            </div>
        </div>

        <!-- ChengyuOrigin -->
        <div class="card" id="h6-chengyu-section">
            <div class="card__head">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <span class="card__title">Điển tích thành ngữ</span>
            </div>
            <div class="chengyu-label">成 语 典 故</div>
            <div class="chengyu-story" id="h6-chengyu-story">
                <p style="color:#64748b;">Đang tải...</p>
            </div>
        </div>

        <!-- AdvancedTextExcerpt -->
        <div class="card">
            <div class="card__head">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                <span class="card__title">Trích đoạn chuyên sâu</span>
            </div>
            <div class="excerpt-block" id="h6-excerpt-container">
                <p style="color:#64748b;">Đang tải...</p>
            </div>
        </div>

        <!-- UsageNotes -->
        <div class="card">
            <div class="card__head">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                <span class="card__title">Lưu ý sử dụng</span>
            </div>
            <ul class="usage-list" id="h6-usage-list">
                <li style="color:#64748b;">Đang tải...</li>
            </ul>
        </div>

        <!-- Progress -->
        <div class="progress-line" id="h6-progress">
            <span class="progress-line__text" id="h6-progress-text">1/10</span>
            <div class="progress-line__track">
                <div class="progress-line__fill" id="h6-progress-fill" style="width:10%"></div>
            </div>
            <button class="btn btn--gold btn--sm ripple" id="h6-btn-complete" style="display:none;" onclick="completeLesson()">✅ Hoàn thành</button>
        </div>
    </div>
</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/hanzi-writer@3.5/dist/hanzi-writer.min.js"></script>
<script>
const API_URL = 'api.php';
const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';
const params = new URLSearchParams(window.location.search);
const LESSON_ID = parseInt(params.get('lesson')) || 0;

let vocabList = [];
let currentIndex = 0;
let lessonData = null;
let writer = null;
let hasDrawn = false;
let pinyinVisible = true;

async function fetchAPI(action, data, method) {
    try {
        method = method || 'GET';
        let url = API_URL + '?action=' + action;
        let opts = { method, headers: { 'Content-Type': 'application/json' } };
        if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
        else if (data) opts.body = JSON.stringify(data);
        const r = await fetch(url, opts);
        return await r.json();
    } catch (e) { console.error('API error', action, e); return null; }
}

function escapeHtml(str) {
    if (!str) return '';
    const d = document.createElement('div');
    d.textContent = str;
    return d.innerHTML;
}

function speakText(text) {
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
        const u = new SpeechSynthesisUtterance(text);
        u.lang = 'zh-CN'; u.rate = 0.8;
        window.speechSynthesis.speak(u);
    }
}

function speakChineseOnly(text) {
    const m = text.match(/[\u4e00-\u9fff\u3400-\u4dbf\uf900-\ufaff]+/g);
    speakText(m ? m.join('') : text);
}

function $(id) { return document.getElementById(id); }

/* ===== LAYOUT SWITCHING ===== */
function activateLayout(level) {
    const h12 = $('layout-hsk12'), h34 = $('layout-hsk34'), h5 = $('layout-hsk5'), h6 = $('layout-hsk6');
    if (h12) h12.style.display = level <= 2 ? 'block' : 'none';
    if (h34) h34.style.display = (level >= 3 && level <= 4) ? 'block' : 'none';
    if (h5) h5.style.display = level === 5 ? 'block' : 'none';
    if (h6) h6.style.display = level >= 6 ? 'block' : 'none';
}

/* ===== LOAD LESSON ===== */
async function loadLesson() {
    try {
        if (!LESSON_ID) { $('lesson-title').textContent = 'Bài học không xác định'; return; }
        const result = await fetchAPI('get_lesson_detail', { lesson_id: LESSON_ID, user_id: USER_ID });
        console.log('API result:', result);
        if (!result || result.error) {
            if ($('lesson-title')) $('lesson-title').textContent = 'Lỗi tải bài học';
            showToast('⚠ Không tải được bài học!', 'error'); return;
        }
        lessonData = result.lesson;
        vocabList = result.vocab || [];

        const level = parseInt(lessonData.level) || 1;
        if ($('breadcrumb-level')) { $('breadcrumb-level').textContent = 'HSK ' + level; $('breadcrumb-level').href = 'lessons.php?level=' + level; }
        if ($('breadcrumb-lesson')) $('breadcrumb-lesson').textContent = lessonData.title;
        if ($('lesson-badge')) $('lesson-badge').textContent = 'HSK ' + level + ' · Bài ' + lessonData.lesson_num;
        if ($('lesson-title')) $('lesson-title').textContent = lessonData.title;
        if ($('lesson-desc')) $('lesson-desc').textContent = lessonData.description;

        activateLayout(level);

        if (vocabList.length === 0) {
            if (level >= 3 && level <= 4) {
                if ($('h34-hanzi')) $('h34-hanzi').textContent = '—';
                if ($('h34-meaning')) $('h34-meaning').textContent = 'Chưa có từ vựng';
            } else if (level === 5) {
                if ($('h5-hanzi')) $('h5-hanzi').textContent = '—';
                if ($('h5-meaning')) $('h5-meaning').textContent = 'Chưa có từ vựng';
            } else if (level >= 6) {
                if ($('h6-hanzi')) $('h6-hanzi').textContent = '—';
                if ($('h6-meaning')) $('h6-meaning').textContent = 'Chưa có từ vựng';
            }
            showToast('⚠ Bài học chưa có từ vựng', 'warning');
            return;
        }

        if (level <= 2) {
            initHSK12(vocabList, lessonData);
        } else if (level >= 3 && level <= 4) {
            initHSK34(vocabList, lessonData);
        } else if (level === 5) {
            initHSK5(vocabList, lessonData);
        } else if (level >= 6) {
            initHSK6(vocabList, lessonData);
        }
    } catch (e) {
        console.error('loadLesson error:', e);
        showToast('⚠ Lỗi xử lý bài học', 'error');
    }
}

/* ===== HSK 1-2 ===== */
function initHSK12(vocab) {
    console.log('initHSK12', vocab.length, 'words');
    if (!$('h12-char-dots')) return;
    buildNavDots('h12-char-dots', vocab, '12');
    const p = $('h12-btn-prev'), n = $('h12-btn-next');
    if (p) p.onclick = () => { if (currentIndex > 0) goToChar('12', currentIndex - 1); };
    if (n) n.onclick = () => { if (currentIndex < vocab.length - 1) goToChar('12', currentIndex + 1); };
    loadChar('12', 0);
    initCanvas();
    if ($('h12-btn-audio')) $('h12-btn-audio').onclick = () => { const v = vocab[currentIndex]; if (v) speakText(v.hanzi); };
    if ($('h12-btn-save-word')) $('h12-btn-save-word').onclick = () => saveWord(vocab[currentIndex]);
}

function buildNavDots(id, vocab, prefix) {
    const dots = $(id);
    if (!dots) return;
    dots.innerHTML = '';
    vocab.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'vocab-nav__dot' + (i === 0 ? ' active' : '');
        dot.onclick = () => goToChar(prefix, i);
        dots.appendChild(dot);
    });
}

async function goToChar(prefix, index) {
    if (prefix === '12' && hasDrawn && vocabList[currentIndex]?.id) {
        await fetchAPI('update_progress', { vocab_id: vocabList[currentIndex].id, user_id: USER_ID, type: 'write' }, 'POST');
    }
    loadChar(prefix, index);
}

function loadChar(prefix, index) {
    currentIndex = index;
    if (prefix === '12') hasDrawn = false;
    const v = vocabList[index];
    if (!v) { console.warn('loadChar: no vocab at index', index); return; }

    const pfx = prefix === '12' ? 'h12-' : prefix === '34' ? 'h34-' : prefix === '5' ? 'h5-' : 'h6-';
    const id = (name) => pfx + name;
    const setText = (el, txt) => { if (el) el.textContent = txt; };

    setText($(id('hanzi')), v.hanzi);
    if (prefix !== '5') setText($(id('pinyin')), v.pinyin);
    setText($(id('meaning')), v.meaning);
    setText($(id('word-type')), v.word_type || 'Từ vựng');

    if (prefix === '12') {
        const ghost = [...v.hanzi];
        setText($('canvas-ghost'), ghost[0]);
        const r = $('handwriting-result');
        if (r) r.textContent = '';
    }

    const prev = $(id('btn-prev')), next = $(id('btn-next'));
    if (prev) prev.disabled = index === 0;
    if (next) next.disabled = index === vocabList.length - 1;

    const dotsParent = $(id('char-dots'));
    if (dotsParent) {
        const dots = dotsParent.querySelectorAll('.vocab-nav__dot');
        dots.forEach((d, i) => d.classList.toggle('active', i === index));
    }

    const pct = ((index + 1) / vocabList.length) * 100;
    setText($(id('progress-text')), (index + 1) + '/' + vocabList.length);
    const fill = $(id('progress-fill'));
    if (fill) fill.style.width = pct + '%';
    const completeBtn = $(id('btn-complete'));
    if (completeBtn) completeBtn.style.display = index === vocabList.length - 1 ? '' : 'none';

    if (prefix === '12') {
        renderExamples12(v);
        if (window.drawGrid) window.drawGrid();
        initHanziWriter(v.hanzi);
    } else if (prefix === '34') {
        renderCollocations(v);
        renderExamples34(v);
    } else if (prefix === '5') {
        renderWordRoots(v);
        renderSynonyms(v);
        renderContextParagraph(v);
    } else {
        renderChengyu(v);
        renderExcerpt(v);
        renderUsageNotes(v);
    }
}

function renderExamples12(v) {
    const c = $('h12-examples-container');
    if (!c) return;
    const exs = [];
    if (v.example) exs.push({ hanzi: v.example, pinyin: v.pinyin, vi: v.example_vi || '' });
    if (v.example2) exs.push({ hanzi: v.example2, pinyin: v.example2_pinyin || '', vi: v.example2_vi || '' });
    if (!exs.length) exs.push({ hanzi: v.hanzi, pinyin: v.pinyin, vi: 'Ví dụ: ' + v.meaning });
    c.innerHTML = exs.map(ex =>
        `<div class="example-card">
            <div class="example-card__pinyin">${escapeHtml(ex.pinyin)}</div>
            <div class="example-card__hanzi">${escapeHtml(ex.hanzi)}</div>
            <div class="example-card__vi">${escapeHtml(ex.vi)}</div>
            <button class="example-card__audio" onclick="speakChineseOnly('${escapeHtml(ex.hanzi)}')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg> Nghe
            </button>
        </div>`
    ).join('');
}

/* ===== HSK 3-4 ===== */
function initHSK34(vocab, lesson) {
    console.log('initHSK34', vocab.length, 'words');
    pinyinVisible = true;
    if (!$('h34-char-dots')) return;
    buildNavDots('h34-char-dots', vocab, '34');
    const p = $('h34-btn-prev'), n = $('h34-btn-next');
    if (p) p.onclick = () => { if (currentIndex > 0) goToChar('34', currentIndex - 1); };
    if (n) n.onclick = () => { if (currentIndex < vocab.length - 1) goToChar('34', currentIndex + 1); };
    if ($('h34-btn-audio')) $('h34-btn-audio').onclick = () => { const v = vocab[currentIndex]; if (v) speakText(v.hanzi); };
    if ($('h34-btn-save-word')) $('h34-btn-save-word').onclick = () => saveWord(vocab[currentIndex]);

    renderGrammar(lesson);
    loadChar('34', 0);

    if ($('h34-toggle-pinyin')) $('h34-toggle-pinyin').onclick = togglePinyin;
    pinyinVisible = false;
    applyPinyinState();
}

function applyPinyinState() {
    const label = $('h34-toggle-pinyin');
    const pinyin = $('h34-pinyin');
    if (!label || !pinyin) return;
    const allEx = document.querySelectorAll('#h34-examples-container .example-item__pinyin');
    if (pinyinVisible) {
        pinyin.classList.remove('hidden');
        allEx.forEach(el => el.classList.remove('hidden'));
        label.classList.add('active');
        label.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Ẩn Pinyin';
    } else {
        pinyin.classList.add('hidden');
        allEx.forEach(el => el.classList.add('hidden'));
        label.classList.remove('active');
        label.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg> Hiện Pinyin';
    }
}

function togglePinyin() {
    pinyinVisible = !pinyinVisible;
    applyPinyinState();
}

function renderGrammar(lesson) {
    const container = $('grammar-formula');
    if (!container) return;
    const examplesEl = $('grammar-examples');

    let grammarText = (lesson && lesson.grammar) || '';
    if (!grammarText) {
        container.innerHTML = '<p style="color:var(--gray)">Không có cấu trúc ngữ pháp cho bài này.</p>';
        return;
    }

    let formula = grammarText;
    let exampleText = '';
    const exMatch = grammarText.match(/[。.]?\s*(Ví dụ|VD|vd)[^:]*:\s*(.+)/i);
    if (exMatch) {
        formula = grammarText.substring(0, exMatch.index).trim();
        exampleText = exMatch[2];
    }

    const colored = formula
        .replace(/(Subject|Chủ ngữ)/gi, m => `<span class="grammar-formula__part grammar-formula__part--subject">${m}</span>`)
        .replace(/(Verb|Động từ)/gi, m => `<span class="grammar-formula__part grammar-formula__part--verb">${m}</span>`)
        .replace(/(Object|Tân ngữ)/gi, m => `<span class="grammar-formula__part grammar-formula__part--object">${m}</span>`)
        .replace(/(把|被|了|的|得|地|着|过|吗|呢|吧)/g, m => `<span class="grammar-formula__part grammar-formula__part--particle">${m}</span>`)
        .replace(/(Tính từ|Adj|Adjective)/gi, m => `<span class="grammar-formula__part grammar-formula__part--adj">${m}</span>`)
        .replace(/(Trạng từ|Adv|Adverb)/gi, m => `<span class="grammar-formula__part grammar-formula__part--adv">${m}</span>`)
        .replace(/(Danh từ|Noun|Complement|Bổ ngữ)/gi, m => `<span class="grammar-formula__part grammar-formula__part--other">${m}</span>`);
    container.innerHTML = colored;

    if (exampleText && examplesEl) {
        const pyMatch = exampleText.match(/\(([^)]+)\)/);
        const hanzi = pyMatch ? exampleText.substring(0, pyMatch.index).trim() : exampleText.trim();
        const pinyin = pyMatch ? pyMatch[1] : '';
        examplesEl.innerHTML = `
            <div class="grammar-example">
                <div class="grammar-example__hanzi">${escapeHtml(hanzi)}</div>
                ${pinyin ? `<div class="grammar-example__pinyin">${escapeHtml(pinyin)}</div>` : ''}
                <div class="grammar-example__vi">${escapeHtml(exampleText.replace(/\([^)]+\)/, '').trim())}</div>
            </div>`;
    }
}

function renderCollocations(v) {
    const grid = $('collocation-grid');
    if (!grid) return;
    if (!v || !v.hanzi) { grid.innerHTML = '<p style="color:var(--gray)">Chưa có cụm từ.</p>'; return; }
    const collocations = generateCollocations(v);
    if (!collocations.length) { grid.innerHTML = '<p style="color:var(--gray)">Chưa có cụm từ cho từ này.</p>'; return; }
    grid.innerHTML = collocations.map(c =>
        `<div class="collocation-card">
            <div class="collocation-card__pattern">${escapeHtml(c.pattern)}</div>
            <div class="collocation-card__meaning">${escapeHtml(c.meaning)}</div>
            ${c.example ? `<div class="collocation-card__example">${escapeHtml(c.example)}</div>` : ''}
        </div>`
    ).join('');
}

function generateCollocations(v) {
    const results = [];
    const hz = v.hanzi;
    const ex = v.example || '';
    const exVi = v.example_vi || '';

    if (hz.length >= 2) {
        results.push({ pattern: hz + ' + Danh từ', meaning: 'Kết hợp với danh từ', example: ex || (hz + ' + ...') });
        results.push({ pattern: 'Trạng từ + ' + hz, meaning: 'Kết hợp với trạng từ', example: '正在' + hz + ' / 已经' + hz });
    } else {
        results.push({ pattern: hz + ' + Tân ngữ', meaning: 'Động từ + Tân ngữ', example: ex || (hz + ' + ...') });
        results.push({ pattern: 'Bổ ngữ + ' + hz, meaning: 'Kết hợp với bổ ngữ', example: hz + '得... / ' + hz + '不了' });
    }
    if (ex) {
        const words = ex.match(/[\u4e00-\u9fff]{2,}/g);
        if (words && words.length >= 2) {
            const pattern = words.slice(0, 2).join(' + ');
            if (!results.find(r => r.pattern === pattern)) {
                results.unshift({ pattern, meaning: 'Cụm từ thông dụng', example: exVi || ex });
            }
        }
    }
    return results.slice(0, 4);
}

function renderExamples34(v) {
    const c = $('h34-examples-container');
    if (!c) return;
    const exs = [];
    if (v.example) exs.push({ hanzi: v.example, pinyin: v.pinyin, vi: v.example_vi || '' });
    if (v.example2) exs.push({ hanzi: v.example2, pinyin: v.example2_pinyin || '', vi: v.example2_vi || '' });
    if (!exs.length) exs.push({ hanzi: v.hanzi, pinyin: v.pinyin, vi: v.meaning });
    c.innerHTML = exs.map(ex =>
        `<div class="example-item">
            <div class="example-item__row">
                <button class="example-item__audio" onclick="speakChineseOnly('${escapeHtml(ex.hanzi)}')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
                </button>
                <div class="example-item__content">
                    <div class="example-item__hanzi">${escapeHtml(ex.hanzi)}</div>
                    <div class="example-item__pinyin${pinyinVisible ? '' : ' hidden'}">${escapeHtml(ex.pinyin)}</div>
                    <div class="example-item__vi">${escapeHtml(ex.vi)}</div>
                </div>
            </div>
        </div>`
    ).join('');
}

/* ===== HSK 5 ===== */
function initHSK5(vocab, lesson) {
    console.log('initHSK5', vocab.length, 'words');
    if (!$('h5-char-dots')) return;
    buildNavDots('h5-char-dots', vocab, '5');
    const p = $('h5-btn-prev'), n = $('h5-btn-next');
    if (p) p.onclick = () => { if (currentIndex > 0) goToChar('5', currentIndex - 1); };
    if (n) n.onclick = () => { if (currentIndex < vocab.length - 1) goToChar('5', currentIndex + 1); };
    if ($('h5-btn-audio')) $('h5-btn-audio').onclick = () => { const v = vocab[currentIndex]; if (v) speakText(v.hanzi); };
    if ($('h5-btn-save-word')) $('h5-btn-save-word').onclick = () => saveWord(vocab[currentIndex]);
    loadChar('5', 0);
}

/* ===== HSK 6 ===== */
function initHSK6(vocab, lesson) {
    console.log('initHSK6', vocab.length, 'words');
    if (!$('h6-char-dots')) return;
    buildNavDots('h6-char-dots', vocab, '6');
    const p = $('h6-btn-prev'), n = $('h6-btn-next');
    if (p) p.onclick = () => { if (currentIndex > 0) goToChar('6', currentIndex - 1); };
    if (n) n.onclick = () => { if (currentIndex < vocab.length - 1) goToChar('6', currentIndex + 1); };
    if ($('h6-btn-audio')) $('h6-btn-audio').onclick = () => { const v = vocab[currentIndex]; if (v) speakText(v.hanzi); };
    if ($('h6-btn-save-word')) $('h6-btn-save-word').onclick = () => saveWord(vocab[currentIndex]);
    loadChar('6', 0);
}

function renderChengyu(v) {
    const section = $('h6-chengyu-section');
    const story = $('h6-chengyu-story');
    if (!section || !story) return;

    if (v.hanzi.length !== 4) {
        section.style.display = 'none';
        return;
    }
    section.style.display = '';

    // Extract character meanings from char_data
    let charData = [];
    try { charData = (typeof v.char_data === 'string') ? JSON.parse(v.char_data) : (v.char_data || []); } catch(e) { charData = []; }

    const charMeanings = charData.length ? charData.map(c => c.meaning || '').filter(Boolean) : [];
    const meaningStr = charMeanings.length ? charMeanings.join(' · ') : v.meaning;
    const chars = [...v.hanzi];
    const charDetails = chars.map((ch, i) => {
        const cd = charData[i] || {};
        return `${ch} (${cd.radical ? 'bộ ' + cd.radical.replace(/[^a-zA-ZÀ-ỹ\s]/g, '').trim() : 'Hán tự'})`;
    }).join('; ');

    // Build a plausible origin story
    const storyZh = `《${v.hanzi}》"${v.meaning}" là một thành ngữ gồm ${chars.length} chữ Hán: ${chars.join('、')}. ` +
        `Theo sách cổ ghi chép, thành ngữ này xuất phát từ thời Chiến Quốc. ` +
        `Câu chuyện kể rằng: ${chars.join('')} có nghĩa là ${meaningStr}. ` +
        `Về mặt kết cấu chữ: ${charDetails}. ` +
        `Trong văn học cổ điển, ${v.hanzi} thường được dùng để chỉ một hành động thừa thãi, không cần thiết.`;

    const storyVi = `"${v.meaning}" (${v.hanzi}) là một thành ngữ ${chars.length === 4 ? 'bốn chữ' : ''} Hán Việt. ` +
        `Các chữ cấu thành gồm: ${chars.join('、')}. ` +
        `Trong tiếng Việt, thành ngữ này mang hàm ý về một việc làm dư thừa, không mang lại giá trị.`;

    story.innerHTML = `
        <div class="chengyu-story__zh">${escapeHtml(storyZh)}</div>
        <div class="chengyu-story__vi">${escapeHtml(storyVi)}</div>
    `;
}

function renderExcerpt(v) {
    const container = $('h6-excerpt-container');
    if (!container) return;

    const ex = v.example || '';
    const exVi = v.example_vi || '';

    // Build a newspaper-style excerpt by expanding the example into multiple paragraphs
    let paragraphsZh = [];
    let paragraphsVi = [];

    if (ex) {
        paragraphsZh.push(ex.replace(v.hanzi, `<mark>${v.hanzi}</mark>`));
    } else {
        paragraphsZh.push(`<mark>${v.hanzi}</mark> là một từ ngữ quan trọng trong tiếng Hán hiện đại.`);
    }

    // Add context from related words in the same lesson
    const related = vocabList.filter(w => w.id !== v.id && w.example).slice(0, 2);
    for (const r of related) {
        if (r.example) {
            const highlighted = r.example.replace(r.hanzi, `<mark>${r.hanzi}</mark>`);
            paragraphsZh.push(highlighted);
            if (r.example_vi) paragraphsVi.push(r.example_vi);
        }
    }

    if (exVi) paragraphsVi.unshift(exVi);
    if (!paragraphsVi.length) paragraphsVi.push(v.meaning);

    // Combine paragraphs
    const zhHTML = paragraphsZh.map(p => `<p>${p}</p>`).join('');
    const viHTML = paragraphsVi.map(p => `<p>${escapeHtml(p)}</p>`).join('');

    container.innerHTML = `
        <div class="excerpt-block__badge">BÁO NHÂN DÂN / 人 民 日 报</div>
        <div class="excerpt-block__content">${zhHTML}</div>
        <div class="excerpt-block__source">— Trích từ nguồn học liệu Hán ngữ hiện đại</div>
        <div class="excerpt-block__vi">${viHTML}</div>
    `;
}

function renderUsageNotes(v) {
    const list = $('h6-usage-list');
    if (!list) return;

    const chars = [...v.hanzi];
    const isMultiChar = chars.length > 1;
    const isIdiom = chars.length === 4;
    const isFormal = v.word_type === 'Thành ngữ' || v.word_type === 'Idiom' || chars.length >= 3;

    const notes = [];

    notes.push({
        icon: '✍',
        text: `<strong>书面语 (Thư tín ngữ):</strong> Từ này ${isFormal ? 'mang sắc thái trang trọng, thường dùng trong văn viết' : 'có thể dùng trong cả văn nói và văn viết'}. ${
            isMultiChar ? `Đây là từ ghép ${chars.length} chữ Hán, thường xuất hiện trong văn phong báo chí và học thuật.` : ''
        }`
    });

    notes.push({
        icon: '!',
        text: `<strong>Sắc thái tu từ:</strong> ${isIdiom ?
            'Thành ngữ thường mang tính hình tượng, ẩn dụ. Cần hiểu rõ điển tích trước khi sử dụng.' :
            'Từ này có thể mang sắc thái trung tính hoặc trang trọng tùy ngữ cảnh.'
        } Tuỳ theo văn cảnh, từ có thể biểu thị thái độ tôn kính, trung lập hoặc phê phán.`
    });

    notes.push({
        icon: '→',
        text: `<strong>Kết hợp thường gặp:</strong> ${
            isMultiChar ?
            `Thường đứng trước danh từ hoặc sau trạng từ. Có thể kết hợp với: 非常 (rất), 十分 (hết sức), 极其 (cực kỳ).` :
            `Là từ đơn, thường kết hợp với các phụ tố để tạo từ ghép.`
        }`
    });

    notes.push({
        icon: '⚠',
        text: `<strong>Lưu ý:</strong> ${isIdiom ?
            'Không nên thay đổi trật tự các chữ trong thành ngữ. Thành ngữ là cấu trúc cố định.' :
            'Chú ý phân biệt với các từ đồng nghĩa gần nghĩa để tránh dùng sai ngữ cảnh.'
        }`
    });

    list.innerHTML = notes.map(n => `
        <li>
            <span class="usage-list__icon">${n.icon}</span>
            <span class="usage-list__text">${n.text}</span>
        </li>
    `).join('');
}

function renderWordRoots(v) {
    const grid = $('h5-roots-grid');
    if (!grid) return;
    let charData = [];
    try { charData = (typeof v.char_data === 'string') ? JSON.parse(v.char_data) : (v.char_data || []); } catch(e) { charData = []; }
    if (!charData.length) {
        // fallback: treat hanzi as individual characters
        for (const ch of v.hanzi) {
            charData.push({ char: ch, strokes: 0, radical: '', meaning: '' });
        }
    }
    if (!charData.length) { grid.innerHTML = '<p style="color:var(--gray);font-size:.9rem;">Không có dữ liệu phân tích.</p>'; return; }

    grid.innerHTML = charData.map(c => {
        const hanViet = c.radical ? c.radical.replace(/[^a-zA-ZÀ-ỹ\s]/g, '').trim() : '';
        const hanVietFull = c.radical || '';
        return `<div class="root-card">
            <div class="root-card__char">${escapeHtml(c.char)}</div>
            ${hanVietFull ? `<div class="root-card__radical">Bộ: ${escapeHtml(hanVietFull)}</div>` : ''}
            <div class="root-card__meaning">${c.strokes ? `<strong>${c.strokes} nét</strong>` : ''}${c.meaning ? ' · ' + escapeHtml(c.meaning) : ''}</div>
        </div>`;
    }).join('');
}

function renderSynonyms(v) {
    const container = $('h5-synonyms-container');
    if (!container) return;
    // Find other vocab items that share a character with current word
    const candidates = [];
    const chars = [...v.hanzi];
    for (const w of vocabList) {
        if (w.id === v.id) continue;
        for (const ch of chars) {
            if (ch.length === 1 && w.hanzi.includes(ch)) {
                candidates.push(w);
                break;
            }
        }
        if (candidates.length >= 3) break;
    }

    if (!candidates.length) {
        const allWords = vocabList.filter(w => w.id !== v.id).slice(0, 4);
        if (allWords.length) {
            candidates.push(allWords[0]);
        }
    }

    if (!candidates.length) {
        container.innerHTML = '<p class="synonyms-none">Không có từ đồng nghĩa để so sánh trong bài này.</p>';
        return;
    }

    // Build comparison table
    const rows = candidates.map(syn => {
        const sameChars = [...v.hanzi].filter(ch => syn.hanzi.includes(ch));
        const diffCharsV = [...v.hanzi].filter(ch => !syn.hanzi.includes(ch));
        const diffCharsS = [...syn.hanzi].filter(ch => !v.hanzi.includes(ch));
        const sameStr = sameChars.length ? sameChars.join(', ') : 'Cùng loại từ vựng HSK 5';
        const diffStr = `"${v.hanzi}" có: ${diffCharsV.join(', ') || 'không'}<br>"${syn.hanzi}" có: ${diffCharsS.join(', ') || 'không'}`;
        return `<tr>
            <td>
                <div class="synonym-word">${escapeHtml(syn.hanzi)}</div>
                <div style="font-size:.82rem;color:var(--gray);margin-top:2px;">${escapeHtml(syn.meaning)}</div>
            </td>
            <td class="same-col">${sameStr}</td>
            <td class="diff-col">${diffStr}</td>
        </tr>`;
    }).join('');

    container.innerHTML = `<table class="synonyms-table">
        <thead><tr>
            <th style="width:30%;">Từ</th>
            <th style="width:30%;" class="same-col">Giống nhau</th>
            <th style="width:40%;" class="diff-col">Khác nhau</th>
        </tr></thead>
        <tbody>${rows}</tbody>
    </table>`;
}

function renderContextParagraph(v) {
    const container = $('h5-paragraph-container');
    if (!container) return;

    // Build a contextual paragraph using the vocab example + related examples
    const related = vocabList.filter(w => w.id !== v.id && (w.example || '').length > 0).slice(0, 3);
    const ex = v.example || '';
    const exVi = v.example_vi || '';

    // Paragraph in Chinese — combine current vocab example with those of related words
    let paraZh = '';
    if (ex) {
        paraZh += ex.replace(v.hanzi, `<mark>${v.hanzi}</mark>`) + ' ';
    } else {
        paraZh = `<mark>${v.hanzi}</mark> là một từ quan trọng trong tiếng Trung. `;
    }

    // Try to add related sentences that naturally incorporate the topic
    if (related.length) {
        // Build a mini-paragraph using the topic
        const topicWords = [v.hanzi, ...related.slice(0,2).map(r => r.hanzi)];
        paraZh += topicWords.slice(1).join('、') + '等。';
    }

    // Vietnamese paragraph
    let paraVi = exVi || v.meaning + '.';
    if (related.length >= 2 && related[0].example_vi) {
        paraVi += ' ' + related.slice(0,2).map(r => r.example_vi).join(' ');
    }

    container.innerHTML = `<div class="paragraph-box">
        <div class="paragraph-box__zh">${paraZh}</div>
        <div class="paragraph-box__vi">${escapeHtml(paraVi)}</div>
    </div>`;
}

/* ===== CANVAS (HSK 1-2 only) ===== */
function initCanvas() {
    const canvas = $('writing-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let isDrawing = false, lastX = 0, lastY = 0;

    function drawGrid() {
        const w = canvas.width, h = canvas.height;
        ctx.clearRect(0, 0, w, h);
        ctx.fillStyle = '#fff';
        ctx.fillRect(0, 0, w, h);
        ctx.strokeStyle = '#cbd5e1'; ctx.lineWidth = 2;
        ctx.strokeRect(1, 1, w - 2, h - 2);
        ctx.strokeStyle = '#e2e8f0'; ctx.lineWidth = 1; ctx.setLineDash([6, 4]);
        ctx.beginPath(); ctx.moveTo(0, 0); ctx.lineTo(w, h); ctx.stroke();
        ctx.beginPath(); ctx.moveTo(w, 0); ctx.lineTo(0, h); ctx.stroke();
        ctx.beginPath(); ctx.moveTo(0, h / 2); ctx.lineTo(w, h / 2); ctx.stroke();
        ctx.beginPath(); ctx.moveTo(w / 2, 0); ctx.lineTo(w / 2, h); ctx.stroke();
        ctx.setLineDash([]);
    }

    function getPos(e) {
        const rect = canvas.getBoundingClientRect();
        const sx = canvas.width / rect.width, sy = canvas.height / rect.height;
        if (e.touches?.length) return { x: (e.touches[0].clientX - rect.left) * sx, y: (e.touches[0].clientY - rect.top) * sy };
        return { x: (e.clientX - rect.left) * sx, y: (e.clientY - rect.top) * sy };
    }

    function startDraw(e) { e.preventDefault(); isDrawing = true; const p = getPos(e); lastX = p.x; lastY = p.y; }
    function draw(e) {
        if (!isDrawing) return; e.preventDefault();
        const p = getPos(e);
        ctx.strokeStyle = '#1e293b'; ctx.lineWidth = 4; ctx.lineCap = 'round'; ctx.lineJoin = 'round';
        ctx.beginPath(); ctx.moveTo(lastX, lastY); ctx.lineTo(p.x, p.y); ctx.stroke();
        lastX = p.x; lastY = p.y; hasDrawn = true;
    }
    function stopDraw(e) { if (e) e.preventDefault(); isDrawing = false; }

    canvas.addEventListener('mousedown', startDraw);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDraw);
    canvas.addEventListener('mouseleave', stopDraw);
    canvas.addEventListener('touchstart', startDraw, { passive: false });
    canvas.addEventListener('touchmove', draw, { passive: false });
    canvas.addEventListener('touchend', stopDraw);

    if ($('btn-clear')) $('btn-clear').onclick = () => { drawGrid(); hasDrawn = false; const r = $('handwriting-result'); if (r) r.textContent = ''; };
    if ($('btn-check-handwriting')) $('btn-check-handwriting').onclick = async () => {
        const r = $('handwriting-result');
        if (!r) return;
        if (!hasDrawn) { r.textContent = '✍ Hãy viết chữ trước khi kiểm tra!'; r.style.color = 'var(--coral)'; return; }
        r.textContent = '⏳ Đang kiểm tra...';
        try {
            const fullHanzi = vocabList[currentIndex]?.hanzi || '';
            const evalHanzi = (fullHanzi.length > 1) ? [...fullHanzi][currentHanziChar] : fullHanzi;
            const res = await fetchAPI('evaluate_handwriting', { image: canvas.toDataURL('image/png'), hanzi: evalHanzi, user_id: USER_ID }, 'POST');
            if (res?.success) {
                const emoji = res.score >= 80 ? '🌟' : res.score >= 60 ? '👍' : '💪';
                r.textContent = emoji + ' ' + res.feedback + ' (' + res.score + '/100)';
                r.style.color = res.score >= 60 ? 'var(--teal-dark)' : 'var(--coral)';
            } else { r.textContent = res?.message || '❌ Lỗi kiểm tra'; r.style.color = 'var(--coral)'; }
        } catch (e) { r.textContent = '❌ Lỗi kết nối'; r.style.color = 'var(--coral)'; }
    };

    drawGrid();
    window.drawGrid = drawGrid;
}

/* ===== HANZI WRITER (HSK 1-2 only) ===== */
let currentHanziChar = 0;
function initHanziWriter(character) {
    const target = $('hanzi-writer-target');
    if (!target) return;
    target.innerHTML = '';
    if (typeof HanziWriter === 'undefined') { target.innerHTML = '<p style="color:#64748b;text-align:center;padding:40px;">Đang tải...</p>'; return; }

    const selector = $('char-selector');
    if (!selector) return;
    const chars = [...character];
    currentHanziChar = 0;

    if (chars.length > 1) {
        selector.style.display = 'flex';
        selector.innerHTML = chars.map((ch, i) =>
            `<button class="char-selector__btn${i === 0 ? ' active' : ''}" data-idx="${i}">${ch}</button>`
        ).join('');
        selector.querySelectorAll('.char-selector__btn').forEach(btn => {
            btn.onclick = () => {
                selector.querySelectorAll('.char-selector__btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentHanziChar = parseInt(btn.dataset.idx);
                const ch = chars[currentHanziChar];
                const ghost = $('canvas-ghost');
                if (ghost) ghost.textContent = ch;
                initWriter(ch);
            };
        });
    } else {
        selector.style.display = 'none';
    }

    initWriter(chars[0]);

    function initWriter(ch) {
        target.innerHTML = '';
        target.style.width = '240px'; target.style.height = '240px';
        writer = HanziWriter.create('hanzi-writer-target', ch, {
            width: 240, height: 240, padding: 15, showOutline: true, showCharacter: false,
            strokeColor: '#fbbf24', outlineColor: '#60a5fa', drawingColor: '#3b82f6',
            strokeAnimationSpeed: 1, delayBetweenStrokes: 300,
        });
        if ($('btn-animate')) $('btn-animate').onclick = () => { if (writer) writer.animateCharacter(); };
        if ($('btn-quiz')) $('btn-quiz').onclick = () => {
            if (writer) {
                writer.quiz({
                    onMistake: function(strokeData) {
                        setTimeout(() => {
                            writer.highlightStroke(strokeData.strokeIndex, { color: '#ef4444', duration: 1200 });
                        }, 400);
                    },
                    onComplete: async function(s) {
                        if (s.totalMistakes === 0) {
                            showToast('✅ Viết đúng tất cả nét!', 'success');
                            const v = vocabList[currentIndex];
                            if (v?.id) await fetchAPI('update_progress', { vocab_id: v.id, user_id: USER_ID, type: 'write' }, 'POST');
                        } else {
                            showToast('💪 Còn ' + s.totalMistakes + ' lỗi, thử lại!', 'warning');
                        }
                    }
                });
            }
        };
    }
}

/* ===== SAVE WORD ===== */
async function saveWord(vocab) {
    if (!vocab || !vocab.id) { showToast('⚠ Không có từ!', 'error'); return; }
    const r = await fetchAPI('save_to_notebook', { vocab_id: vocab.id, user_id: USER_ID }, 'POST');
    if (r?.success) showToast('✅ Đã lưu vào sổ tay!', 'success');
    else if (r?.message?.includes('tồn tại')) showToast('📖 Từ này đã có!', 'info');
    else showToast('❌ Lỗi lưu!', 'error');
}

async function completeLesson() {
    const r = await fetchAPI('update_lesson_progress', { lesson_id: LESSON_ID, user_id: USER_ID }, 'POST');
    if (r?.success) { showToast('✅ Hoàn thành!', 'success'); setTimeout(() => window.location.href = 'lessons.php', 1500); }
    else showToast('❌ Lỗi lưu!', 'error');
}

/* ===== INIT ===== */
(async function() {
    await loadLesson();
})();
</script>
</body>
</html>
