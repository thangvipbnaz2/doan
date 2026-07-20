<!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Chọn lộ trình học tiếng Trung HSK 1 đến HSK 6 tại HànNgữ.">
  <title>Khóa học tiếng Trung HSK 1–6 | HànNgữ</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Trang bán khóa học: tất cả style được đặt tên cm-* để không ảnh hưởng các trang khác. */
    .course-market {
      --cm-teal: #0d9488;
      --cm-teal-deep: #0a665e;
      --cm-orange: #f97316;
      --cm-ink: #102b2d;
      --cm-muted: #617478;
      --cm-paper: #ffffff;
      --cm-canvas: #f5faf9;
      --cm-soft: #e6f5f2;
      --cm-line: #dceae7;
      --cm-shadow: 0 18px 50px rgba(19, 72, 68, .10);
      --cm-shadow-hover: 0 24px 60px rgba(19, 72, 68, .17);
      position: relative;
      isolation: isolate;
      overflow: hidden;
      padding: 104px 0 88px;
      color: var(--cm-ink);
      background:
        radial-gradient(circle at 97% 8%, rgba(29, 184, 164, .11), transparent 25rem),
        radial-gradient(circle at 1% 58%, rgba(249, 115, 22, .07), transparent 24rem),
        var(--cm-canvas);
    }

    .course-market *,
    .course-market *::before,
    .course-market *::after {
      box-sizing: border-box
    }

    .course-market a {
      color: inherit;
      text-decoration: none
    }

    .cm-wrap {
      width: min(1180px, calc(100% - 48px));
      margin: 0 auto;
      position: relative;
      z-index: 1
    }

    .cm-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--cm-teal-deep);
      font-size: .76rem;
      font-weight: 800;
      letter-spacing: .11em;
      text-transform: uppercase
    }

    .cm-eyebrow::before {
      content: "";
      width: 24px;
      height: 2px;
      border-radius: 5px;
      background: currentColor
    }

    .cm-hero {
      padding-bottom: 46px;
      position: relative
    }

    .cm-hero__shell {
      position: relative;
      display: grid;
      grid-template-columns: minmax(0, 1.08fr) minmax(360px, .92fr);
      gap: 54px;
      align-items: center;
      overflow: hidden;
      padding: clamp(32px, 5vw, 66px);
      border: 1px solid rgba(255, 255, 255, .20);
      border-radius: 32px;
      color: #fff;
      background: linear-gradient(126deg, #0b3738 0%, #0c6460 52%, #0d9488 100%);
      box-shadow: 0 24px 64px rgba(10, 75, 70, .22)
    }

    .cm-hero__shell::before {
      content: "";
      position: absolute;
      width: 500px;
      height: 500px;
      right: -174px;
      top: -300px;
      border: 1px solid rgba(255, 255, 255, .13);
      border-radius: 50%;
      box-shadow: 0 0 0 52px rgba(255, 255, 255, .035), 0 0 0 105px rgba(255, 255, 255, .025);
      pointer-events: none
    }

    .cm-hero__shell::after {
      content: "汉";
      position: absolute;
      right: 15%;
      bottom: -96px;
      font-family: serif;
      font-size: 250px;
      font-weight: 800;
      line-height: 1;
      color: rgba(255, 255, 255, .045);
      pointer-events: none
    }

    .cm-hero__copy {
      position: relative;
      z-index: 1;
      max-width: 630px
    }

    .cm-hero .cm-eyebrow {
      color: #b9fff1
    }

    .cm-hero h1 {
      max-width: 660px;
      margin: 16px 0 18px;
      font-size: clamp(2.25rem, 5vw, 4.15rem);
      font-weight: 900;
      letter-spacing: -.055em;
      line-height: 1.04;
      color: #fff
    }

    .cm-hero h1 em {
      font-style: normal;
      color: #b9fff1
    }

    .cm-hero__lead {
      max-width: 600px;
      margin: 0;
      color: rgba(255, 255, 255, .79);
      font-size: 1.06rem;
      line-height: 1.75
    }

    .cm-hero__actions {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-wrap: wrap;
      margin-top: 30px
    }

    .cm-action {
      display: inline-flex;
      min-height: 49px;
      align-items: center;
      justify-content: center;
      gap: 9px;
      padding: 12px 19px;
      border: 1px solid transparent;
      border-radius: 12px;
      font-size: .93rem;
      font-weight: 800;
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease
    }

    .cm-action:hover {
      transform: translateY(-2px)
    }

    .cm-action:focus-visible,
    .cm-card-link:focus-visible,
    .cm-course-buy:focus-visible,
    .cm-route-card:focus-visible {
      outline: 3px solid #fbbf24;
      outline-offset: 3px
    }

    .cm-action--light {
      color: #083a38;
      background: #fff;
      box-shadow: 0 9px 20px rgba(2, 32, 30, .19)
    }

    .cm-action--ghost {
      color: #fff;
      border-color: rgba(255, 255, 255, .28);
      background: rgba(255, 255, 255, .07)
    }

    .cm-action--ghost:hover {
      background: rgba(255, 255, 255, .14)
    }

    .cm-hero__trust {
      display: flex;
      gap: 18px 24px;
      flex-wrap: wrap;
      margin-top: 34px;
      padding-top: 21px;
      border-top: 1px solid rgba(255, 255, 255, .17)
    }

    .cm-hero__trust span {
      display: flex;
      align-items: center;
      gap: 7px;
      color: rgba(255, 255, 255, .77);
      font-size: .82rem;
      font-weight: 650
    }

    .cm-hero__trust b {
      display: grid;
      place-items: center;
      width: 19px;
      height: 19px;
      border-radius: 50%;
      color: #075b56;
      background: #b9fff1;
      font-size: .72rem
    }

    .cm-roadmap {
      position: relative;
      z-index: 1;
      max-width: 390px;
      justify-self: end;
      width: 100%;
      padding: 20px;
      border: 1px solid rgba(255, 255, 255, .18);
      border-radius: 22px;
      background: rgba(0, 35, 35, .17);
      box-shadow: inset 0 1px rgba(255, 255, 255, .10);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px)
    }

    .cm-roadmap__head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 15px;
      font-size: .8rem;
      font-weight: 750;
      color: #d7fffa
    }

    .cm-roadmap__head span:last-child {
      padding: 4px 8px;
      border-radius: 999px;
      color: #c9fff6;
      background: rgba(189, 255, 244, .12);
      font-size: .67rem;
      letter-spacing: .05em;
      text-transform: uppercase
    }

    .cm-roadmap__list {
      display: grid;
      gap: 7px;
      margin: 0;
      padding: 0;
      list-style: none
    }

    .cm-roadmap__item {
      display: grid;
      grid-template-columns: 32px 1fr auto;
      gap: 11px;
      align-items: center;
      padding: 9px 10px;
      border: 1px solid transparent;
      border-radius: 12px;
      color: rgba(255, 255, 255, .73)
    }

    .cm-roadmap__item--active {
      color: #fff;
      border-color: rgba(211, 255, 247, .27);
      background: rgba(255, 255, 255, .13)
    }

    .cm-roadmap__number {
      display: grid;
      place-items: center;
      width: 29px;
      height: 29px;
      border-radius: 9px;
      background: rgba(255, 255, 255, .11);
      font-size: .69rem;
      font-weight: 850
    }

    .cm-roadmap__item--active .cm-roadmap__number {
      color: #0a5f59;
      background: #c5fff5
    }

    .cm-roadmap__name {
      font-size: .83rem;
      font-weight: 750
    }

    .cm-roadmap__caption {
      font-size: .68rem;
      color: inherit;
      opacity: .72
    }

    .cm-roadmap__arrow {
      font-size: 1.05rem;
      color: #c7fff7
    }

    .cm-roadmap__foot {
      margin: 15px 2px 1px;
      color: rgba(255, 255, 255, .62);
      font-size: .72rem;
      line-height: 1.55
    }

    .cm-proof {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
      margin-top: 20px
    }

    .cm-proof__item {
      display: flex;
      gap: 11px;
      align-items: center;
      min-height: 82px;
      padding: 15px 17px;
      border: 1px solid var(--cm-line);
      border-radius: 16px;
      background: var(--cm-paper);
      box-shadow: 0 8px 20px rgba(15, 71, 65, .04)
    }

    .cm-proof__icon {
      display: grid;
      flex: 0 0 38px;
      place-items: center;
      width: 38px;
      height: 38px;
      border-radius: 12px;
      color: var(--cm-teal-deep);
      background: #dff5f0;
      font-size: 1.05rem
    }

    .cm-proof__item:nth-child(2) .cm-proof__icon {
      color: #9a4a09;
      background: #fff0d8
    }

    .cm-proof__item:nth-child(3) .cm-proof__icon {
      color: #5141a0;
      background: #eeeaff
    }

    .cm-proof__item:nth-child(4) .cm-proof__icon {
      color: #ad3853;
      background: #ffe5ec
    }

    .cm-proof__item strong {
      display: block;
      font-size: .82rem;
      line-height: 1.35;
      color: var(--cm-ink)
    }

    .cm-proof__item small {
      display: block;
      margin-top: 2px;
      color: var(--cm-muted);
      font-size: .73rem;
      line-height: 1.3
    }

    .cm-section {
      margin-top: 88px
    }

    .cm-section--tight {
      margin-top: 68px
    }

    .cm-section__head {
      display: flex;
      align-items: end;
      justify-content: space-between;
      gap: 24px;
      margin-bottom: 27px
    }

    .cm-section__head h2 {
      max-width: 670px;
      margin: 10px 0 0;
      color: var(--cm-ink);
      font-size: clamp(1.7rem, 3.3vw, 2.55rem);
      letter-spacing: -.045em;
      line-height: 1.13
    }

    .cm-section__head p {
      max-width: 365px;
      margin: 0;
      color: var(--cm-muted);
      font-size: .93rem;
      line-height: 1.7
    }

    .cm-course-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 20px
    }

    .cm-course-card {
      --course: #0d9488;
      --course-soft: #def7f1;
      --course-deep: #075e58;
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      overflow: hidden;
      border: 1px solid var(--cm-line);
      border-radius: 22px;
      background: var(--cm-paper);
      box-shadow: 0 10px 28px rgba(15, 71, 65, .055);
      transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease
    }

    .cm-course-card:hover {
      z-index: 1;
      transform: translateY(-7px);
      border-color: var(--course);
      box-shadow: var(--cm-shadow-hover)
    }

    .cm-course-card--popular {
      border: 2px solid #f5a524;
      box-shadow: 0 14px 34px rgba(203, 130, 18, .13)
    }

    .cm-course-card--popular:hover {
      border-color: #e68f0a
    }

    .cm-course-card__badge {
      position: absolute;
      z-index: 2;
      top: 15px;
      right: 15px;
      padding: 6px 9px;
      border-radius: 999px;
      color: #754200;
      background: #fff4ce;
      font-size: .66rem;
      font-weight: 850;
      letter-spacing: .035em;
      text-transform: uppercase
    }

    .cm-course-cover {
      position: relative;
      min-height: 152px;
      padding: 21px 22px;
      overflow: hidden;
      color: #fff;
      background: linear-gradient(133deg, var(--course-deep), var(--course))
    }

    .cm-course-cover::before {
      content: "";
      position: absolute;
      width: 160px;
      height: 160px;
      right: -57px;
      top: -67px;
      border: 1px solid rgba(255, 255, 255, .22);
      border-radius: 50%;
      box-shadow: 0 0 0 22px rgba(255, 255, 255, .07), 0 0 0 47px rgba(255, 255, 255, .04)
    }

    .cm-course-cover::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 38px;
      background: linear-gradient(transparent, rgba(0, 0, 0, .09))
    }

    .cm-course-cover__track {
      position: relative;
      z-index: 1;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 5px 8px;
      border: 1px solid rgba(255, 255, 255, .22);
      border-radius: 8px;
      background: rgba(255, 255, 255, .10);
      font-size: .66rem;
      font-weight: 750;
      letter-spacing: .06em;
      text-transform: uppercase
    }

    .cm-course-cover__level {
      position: relative;
      z-index: 1;
      display: block;
      margin-top: 15px;
      font-size: 1.65rem;
      font-weight: 900;
      letter-spacing: -.04em
    }

    .cm-course-cover__hanzi {
      position: absolute;
      z-index: 1;
      right: 24px;
      bottom: 13px;
      font-family: serif;
      font-size: 4.55rem;
      font-weight: 700;
      line-height: 1;
      color: rgba(255, 255, 255, .92);
      text-shadow: 0 4px 12px rgba(0, 0, 0, .13)
    }

    .cm-course-body {
      display: flex;
      flex: 1;
      flex-direction: column;
      padding: 22px
    }

    .cm-course-kicker {
      display: block;
      margin-bottom: 7px;
      color: var(--course);
      font-size: .75rem;
      font-weight: 850;
      letter-spacing: .075em;
      text-transform: uppercase
    }

    .cm-course-body h3 {
      margin: 0;
      color: var(--cm-ink);
      font-size: 1.23rem;
      line-height: 1.25;
      letter-spacing: -.025em
    }

    .cm-course-desc {
      min-height: 64px;
      margin: 10px 0 15px;
      color: var(--cm-muted);
      font-size: .87rem;
      line-height: 1.58
    }

    .cm-course-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      margin: 0 0 17px;
      padding: 11px 0;
      border-top: 1px solid var(--cm-line);
      border-bottom: 1px solid var(--cm-line)
    }

    .cm-course-stats div {
      padding: 0 7px;
      border-right: 1px solid var(--cm-line)
    }

    .cm-course-stats div:first-child {
      padding-left: 0
    }

    .cm-course-stats div:last-child {
      padding-right: 0;
      border-right: 0
    }

    .cm-course-stats strong {
      display: block;
      color: var(--cm-ink);
      font-size: .83rem;
      line-height: 1.25
    }

    .cm-course-stats span {
      display: block;
      margin-top: 2px;
      color: var(--cm-muted);
      font-size: .65rem;
      line-height: 1.3
    }

    .cm-course-includes {
      display: grid;
      gap: 8px;
      margin: 0 0 19px;
      padding: 0;
      list-style: none;
      color: var(--cm-ink);
      font-size: .81rem;
      line-height: 1.35
    }

    .cm-course-includes li {
      display: flex;
      align-items: flex-start;
      gap: 8px
    }

    .cm-course-includes li::before {
      content: "✓";
      display: grid;
      flex: 0 0 18px;
      place-items: center;
      width: 18px;
      height: 18px;
      margin-top: -1px;
      border-radius: 50%;
      color: var(--course-deep);
      background: var(--course-soft);
      font-size: .68rem;
      font-weight: 900
    }

    .cm-course-price {
      margin-top: auto;
      padding-top: 16px;
      border-top: 1px solid var(--cm-line)
    }

    .cm-course-price__label {
      display: block;
      color: var(--cm-muted);
      font-size: .72rem;
      font-weight: 700
    }

    .cm-course-price__row {
      display: flex;
      align-items: baseline;
      gap: 8px;
      margin-top: 2px
    }

    .cm-course-price strong {
      color: var(--cm-ink);
      font-size: 1.48rem;
      letter-spacing: -.04em;
      line-height: 1.2
    }

    .cm-course-price del {
      color: #93a2a3;
      font-size: .73rem
    }

    .cm-course-price__save {
      display: inline-block;
      margin-top: 6px;
      padding: 4px 7px;
      border-radius: 6px;
      color: var(--course-deep);
      background: var(--course-soft);
      font-size: .66rem;
      font-weight: 800
    }

    .cm-course-actions {
      display: grid;
      grid-template-columns: 1fr 1.25fr;
      gap: 9px;
      margin-top: 17px
    }

    .cm-card-link,
    .cm-course-buy {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 42px;
      padding: 9px 8px;
      border-radius: 10px;
      font-size: .78rem;
      font-weight: 850;
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease
    }

    .cm-card-link {
      color: var(--course-deep);
      border: 1px solid var(--cm-line);
      background: var(--cm-paper)
    }

    .cm-card-link:hover {
      border-color: var(--course);
      background: var(--course-soft)
    }

    .cm-course-buy {
      color: #fff;
      background: var(--course);
      box-shadow: 0 7px 16px color-mix(in srgb, var(--course) 28%, transparent)
    }

    .cm-course-buy:hover {
      transform: translateY(-2px);
      filter: brightness(.96)
    }

    .cm-note {
      display: flex;
      justify-content: center;
      gap: 9px;
      align-items: center;
      margin: 25px auto 0;
      color: var(--cm-muted);
      font-size: .78rem;
      text-align: center
    }

    .cm-note b {
      display: grid;
      place-items: center;
      width: 21px;
      height: 21px;
      border-radius: 50%;
      color: var(--cm-teal-deep);
      background: #dff5f0;
      font-size: .75rem
    }

    .cm-path-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 18px
    }

    .cm-route-card {
      position: relative;
      display: block;
      min-height: 198px;
      padding: 24px;
      overflow: hidden;
      border: 1px solid var(--cm-line);
      border-radius: 18px;
      background: var(--cm-paper);
      box-shadow: 0 8px 24px rgba(15, 71, 65, .045);
      transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease
    }

    .cm-route-card:hover {
      transform: translateY(-5px);
      border-color: var(--route);
      box-shadow: var(--cm-shadow)
    }

    .cm-route-card::after {
      content: attr(data-hanzi);
      position: absolute;
      right: 18px;
      bottom: -25px;
      color: var(--route);
      font-family: serif;
      font-size: 7rem;
      font-weight: 700;
      line-height: 1;
      opacity: .12
    }

    .cm-route-card__step {
      position: relative;
      z-index: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 31px;
      height: 31px;
      border-radius: 10px;
      color: var(--route);
      background: var(--route-soft);
      font-size: .76rem;
      font-weight: 900
    }

    .cm-route-card h3 {
      position: relative;
      z-index: 1;
      max-width: 240px;
      margin: 15px 0 6px;
      color: var(--cm-ink);
      font-size: 1.08rem;
      letter-spacing: -.02em
    }

    .cm-route-card p {
      position: relative;
      z-index: 1;
      max-width: 265px;
      margin: 0;
      color: var(--cm-muted);
      font-size: .82rem;
      line-height: 1.6
    }

    .cm-route-card__link {
      position: absolute;
      z-index: 1;
      bottom: 20px;
      left: 24px;
      color: var(--route);
      font-size: .79rem;
      font-weight: 850
    }

    .cm-route-card__link span {
      margin-left: 4px;
      font-size: 1rem
    }

    .cm-compare {
      overflow: hidden;
      border: 1px solid var(--cm-line);
      border-radius: 20px;
      background: var(--cm-paper);
      box-shadow: 0 10px 28px rgba(15, 71, 65, .055)
    }

    .cm-compare__scroll {
      overflow-x: auto
    }

    .cm-compare table {
      width: 100%;
      min-width: 850px;
      border-collapse: collapse;
      text-align: left
    }

    .cm-compare caption {
      position: absolute;
      width: 1px;
      height: 1px;
      overflow: hidden;
      clip: rect(0 0 0 0);
      white-space: nowrap
    }

    .cm-compare th {
      padding: 15px 17px;
      color: var(--cm-muted);
      background: #eff7f5;
      font-size: .68rem;
      font-weight: 850;
      letter-spacing: .07em;
      text-transform: uppercase
    }

    .cm-compare td {
      padding: 16px 17px;
      border-top: 1px solid var(--cm-line);
      color: var(--cm-muted);
      font-size: .82rem;
      line-height: 1.4
    }

    .cm-compare tbody tr {
      transition: background .15s ease
    }

    .cm-compare tbody tr:hover {
      background: #f7fbfa
    }

    .cm-compare td:first-child {
      color: var(--cm-ink);
      font-weight: 850
    }

    .cm-compare td strong {
      display: block;
      color: var(--cm-ink);
      font-size: .86rem
    }

    .cm-compare td small {
      display: block;
      margin-top: 3px;
      color: var(--cm-muted);
      font-size: .72rem
    }

    .cm-table-link {
      color: var(--cm-teal-deep);
      font-weight: 850;
      white-space: nowrap
    }

    .cm-table-link:hover {
      text-decoration: underline
    }

    .cm-steps {
      display: grid;
      grid-template-columns: 1.1fr .9fr;
      gap: 25px;
      align-items: stretch;
      padding: clamp(25px, 4vw, 44px);
      border-radius: 24px;
      color: #fff;
      background: linear-gradient(130deg, #0e4744, #0a756e);
      box-shadow: 0 18px 46px rgba(10, 101, 94, .18)
    }

    .cm-steps .cm-eyebrow {
      color: #b8fff0
    }

    .cm-steps h2 {
      max-width: 560px;
      margin: 12px 0;
      color: #fff;
      font-size: clamp(1.65rem, 3vw, 2.3rem);
      letter-spacing: -.04em;
      line-height: 1.17
    }

    .cm-steps__intro {
      max-width: 570px;
      margin: 0;
      color: rgba(255, 255, 255, .72);
      font-size: .92rem;
      line-height: 1.72
    }

    .cm-steps__points {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-top: 25px
    }

    .cm-steps__point {
      padding-right: 10px;
      border-right: 1px solid rgba(255, 255, 255, .18)
    }

    .cm-steps__point:last-child {
      border-right: 0
    }

    .cm-steps__point span {
      display: grid;
      place-items: center;
      width: 25px;
      height: 25px;
      margin-bottom: 8px;
      border-radius: 8px;
      color: #075e58;
      background: #c5fff5;
      font-size: .72rem;
      font-weight: 900
    }

    .cm-steps__point strong {
      display: block;
      font-size: .8rem;
      line-height: 1.35
    }

    .cm-steps__point p {
      margin: 3px 0 0;
      color: rgba(255, 255, 255, .65);
      font-size: .7rem;
      line-height: 1.45
    }

    .cm-steps__receipt {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      border: 1px solid rgba(255, 255, 255, .17);
      border-radius: 18px;
      background: rgba(0, 34, 31, .14)
    }

    .cm-receipt {
      width: min(270px, 100%);
      padding: 19px;
      border-radius: 13px;
      color: #153433;
      background: #fff;
      box-shadow: 0 12px 22px rgba(0, 27, 24, .18);
      transform: rotate(2deg)
    }

    .cm-receipt__brand {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-bottom: 12px;
      border-bottom: 1px dashed #bfd4d0;
      color: #0b7168;
      font-size: .74rem;
      font-weight: 900
    }

    .cm-receipt__brand span:last-child {
      color: #8a9d9a;
      font-size: .62rem;
      letter-spacing: .06em
    }

    .cm-receipt h3 {
      margin: 17px 0 5px;
      font-size: .94rem
    }

    .cm-receipt p {
      margin: 0;
      color: #66817d;
      font-size: .74rem;
      line-height: 1.52
    }

    .cm-receipt__amount {
      display: flex;
      align-items: baseline;
      justify-content: space-between;
      margin: 16px 0;
      padding: 12px 0;
      border-top: 1px solid #e5efed;
      border-bottom: 1px solid #e5efed
    }

    .cm-receipt__amount span {
      font-size: .7rem;
      color: #66817d
    }

    .cm-receipt__amount strong {
      font-size: 1.1rem;
      color: #123c38
    }

    .cm-receipt__ok {
      display: flex;
      align-items: center;
      gap: 7px;
      color: #087168;
      font-size: .71rem;
      font-weight: 850
    }

    .cm-receipt__ok b {
      display: grid;
      place-items: center;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      color: #fff;
      background: #0d9488;
      font-size: .65rem
    }

    .cm-faq {
      display: grid;
      grid-template-columns: minmax(0, .75fr) minmax(0, 1.25fr);
      gap: 42px;
      align-items: start
    }

    .cm-faq__intro h2 {
      margin: 10px 0 12px;
      color: var(--cm-ink);
      font-size: clamp(1.65rem, 3vw, 2.38rem);
      letter-spacing: -.045em;
      line-height: 1.13
    }

    .cm-faq__intro p {
      max-width: 330px;
      margin: 0;
      color: var(--cm-muted);
      font-size: .9rem;
      line-height: 1.7
    }

    .cm-faq-list {
      display: grid;
      gap: 10px
    }

    .cm-faq-list details {
      border: 1px solid var(--cm-line);
      border-radius: 13px;
      background: var(--cm-paper);
      transition: border-color .2s ease, box-shadow .2s ease
    }

    .cm-faq-list details[open] {
      border-color: #a9d9d2;
      box-shadow: 0 8px 20px rgba(15, 71, 65, .055)
    }

    .cm-faq-list summary {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 17px 19px;
      cursor: pointer;
      color: var(--cm-ink);
      font-size: .88rem;
      font-weight: 800;
      list-style: none
    }

    .cm-faq-list summary::-webkit-details-marker {
      display: none
    }

    .cm-faq-list summary::after {
      content: "+";
      display: grid;
      place-items: center;
      flex: 0 0 22px;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      color: var(--cm-teal-deep);
      background: #e4f6f2;
      font-size: 1.1rem;
      font-weight: 500
    }

    .cm-faq-list details[open] summary::after {
      content: "–"
    }

    .cm-faq-list details p {
      margin: 0;
      padding: 0 19px 18px;
      color: var(--cm-muted);
      font-size: .84rem;
      line-height: 1.7
    }

    .cm-final {
      margin-top: 72px;
      text-align: center
    }

    .cm-final__box {
      position: relative;
      overflow: hidden;
      padding: clamp(31px, 5vw, 54px) 24px;
      border: 1px solid #b8e1d9;
      border-radius: 24px;
      background: linear-gradient(125deg, #e0f8f2, #f4fffc 58%, #fff3e2);
      box-shadow: 0 14px 34px rgba(15, 71, 65, .07)
    }

    .cm-final__box::before,
    .cm-final__box::after {
      position: absolute;
      font-family: serif;
      font-size: 8rem;
      font-weight: 800;
      line-height: 1;
      color: rgba(13, 148, 136, .08)
    }

    .cm-final__box::before {
      content: "学";
      left: 6%;
      bottom: -51px
    }

    .cm-final__box::after {
      content: "习";
      right: 7%;
      top: -47px
    }

    .cm-final h2,
    .cm-final p,
    .cm-final a {
      position: relative;
      z-index: 1
    }

    .cm-final h2 {
      margin: 10px 0;
      color: var(--cm-ink);
      font-size: clamp(1.65rem, 3vw, 2.4rem);
      letter-spacing: -.045em;
      line-height: 1.14
    }

    .cm-final p {
      max-width: 550px;
      margin: 0 auto 22px;
      color: var(--cm-muted);
      font-size: .91rem;
      line-height: 1.7
    }

    .cm-final .cm-action {
      color: #fff;
      background: var(--cm-teal);
      box-shadow: 0 9px 20px rgba(13, 148, 136, .24)
    }

    /* Dark mode from the shared navigation toggle. */
    [data-theme="dark"] .course-market {
      --cm-ink: #effaf8;
      --cm-muted: #b4c7c4;
      --cm-paper: #152321;
      --cm-canvas: #0c1715;
      --cm-soft: #1e3935;
      --cm-line: #29413d;
      background: radial-gradient(circle at 97% 8%, rgba(29, 184, 164, .12), transparent 25rem), radial-gradient(circle at 1% 58%, rgba(249, 115, 22, .09), transparent 24rem), var(--cm-canvas)
    }

    [data-theme="dark"] .cm-proof__item,
    [data-theme="dark"] .cm-course-card,
    [data-theme="dark"] .cm-route-card,
    [data-theme="dark"] .cm-compare,
    [data-theme="dark"] .cm-faq-list details {
      background: var(--cm-paper)
    }

    [data-theme="dark"] .cm-course-price strong,
    [data-theme="dark"] .cm-course-body h3,
    [data-theme="dark"] .cm-route-card h3,
    [data-theme="dark"] .cm-compare td strong,
    [data-theme="dark"] .cm-compare td:first-child {
      color: var(--cm-ink)
    }

    [data-theme="dark"] .cm-card-link {
      background: transparent;
      border-color: var(--cm-line)
    }

    [data-theme="dark"] .cm-compare th {
      background: #1a302c
    }

    [data-theme="dark"] .cm-compare tbody tr:hover {
      background: #19312d
    }

    [data-theme="dark"] .cm-final__box {
      border-color: #315c54;
      background: linear-gradient(125deg, #15342f, #17302d 60%, #312c21)
    }

    @media (max-width:1050px) {
      .cm-hero__shell {
        grid-template-columns: 1fr;
        gap: 32px
      }

      .cm-roadmap {
        justify-self: start;
        max-width: 570px
      }

      .cm-proof {
        grid-template-columns: repeat(2, 1fr)
      }

      .cm-course-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr))
      }

      .cm-steps {
        grid-template-columns: 1fr
      }

      .cm-steps__receipt {
        min-height: 225px
      }

      .cm-faq {
        grid-template-columns: 1fr;
        gap: 26px
      }

      .cm-faq__intro p {
        max-width: 650px
      }
    }

    @media (max-width:720px) {
      .course-market {
        padding: 88px 0 54px
      }

      .cm-wrap {
        width: min(100% - 32px, 1180px)
      }

      .cm-hero {
        padding-bottom: 30px
      }

      .cm-hero__shell {
        padding: 31px 24px;
        border-radius: 23px
      }

      .cm-hero h1 {
        font-size: clamp(2.05rem, 10vw, 3rem)
      }

      .cm-hero__lead {
        font-size: .96rem
      }

      .cm-hero__trust {
        gap: 12px 17px
      }

      .cm-roadmap {
        padding: 15px
      }

      .cm-roadmap__item {
        padding: 7px 8px
      }

      .cm-proof {
        grid-template-columns: 1fr
      }

      .cm-proof__item {
        min-height: 70px
      }

      .cm-section {
        margin-top: 58px
      }

      .cm-section__head {
        display: block;
        margin-bottom: 22px
      }

      .cm-section__head p {
        max-width: 600px;
        margin-top: 13px
      }

      .cm-course-grid,
      .cm-path-grid {
        grid-template-columns: 1fr
      }

      .cm-course-card--popular {
        order: -1
      }

      .cm-course-desc {
        min-height: 0
      }

      .cm-course-actions {
        grid-template-columns: 1fr 1.2fr
      }

      .cm-steps {
        padding: 27px 22px;
        border-radius: 19px
      }

      .cm-steps__points {
        gap: 9px
      }

      .cm-steps__point {
        padding-right: 7px
      }

      .cm-steps__point strong {
        font-size: .73rem
      }

      .cm-steps__point p {
        font-size: .66rem
      }

      .cm-final {
        margin-top: 54px
      }

      .cm-final__box {
        border-radius: 18px
      }
    }

    @media (max-width:420px) {
      .cm-wrap {
        width: min(100% - 24px, 1180px)
      }

      .cm-hero__shell {
        padding: 27px 18px
      }

      .cm-action {
        width: 100%
      }

      .cm-hero__trust span {
        font-size: .74rem
      }

      .cm-roadmap__item {
        grid-template-columns: 29px 1fr auto;
        gap: 7px
      }

      .cm-roadmap__name {
        font-size: .76rem
      }

      .cm-course-body {
        padding: 19px
      }

      .cm-course-cover {
        padding: 19px;
        min-height: 142px
      }

      .cm-course-actions {
        grid-template-columns: 1fr
      }

      .cm-steps__points {
        grid-template-columns: 1fr
      }

      .cm-steps__point {
        display: grid;
        grid-template-columns: 28px 1fr;
        column-gap: 8px;
        padding: 0 0 9px;
        border-right: 0;
        border-bottom: 1px solid rgba(255, 255, 255, .18)
      }

      .cm-steps__point:last-child {
        padding-bottom: 0;
        border-bottom: 0
      }

      .cm-steps__point span {
        grid-row: span 2;
        margin: 0
      }

      .cm-steps__point p {
        margin: 2px 0 0
      }

      .cm-steps__receipt {
        padding: 14px
      }

      .cm-receipt {
        transform: none
      }

      .cm-final__box {
        padding-left: 18px;
        padding-right: 18px
      }
    }

    @media (prefers-reduced-motion:reduce) {

      .cm-course-card,
      .cm-route-card,
      .cm-action,
      .cm-card-link,
      .cm-course-buy {
        transition: none
      }

      .cm-course-card:hover,
      .cm-route-card:hover,
      .cm-action:hover,
      .cm-course-buy:hover {
        transform: none
      }
    }
  </style>
</head>

<body>
  <?php include 'sidebar.php'; ?>

  <main class="course-market" id="main-content">
    <section class="cm-hero" aria-labelledby="course-page-title">
      <div class="cm-wrap">
        <div class="cm-hero__shell">
          <div class="cm-hero__copy">
            <span class="cm-eyebrow">Lộ trình học tiếng Trung online</span>
            <h1 id="course-page-title">Học đúng lộ trình.<br><em>Giỏi tiếng Trung</em> theo cách của bạn.</h1>
            <p class="cm-hero__lead">Từ những nét Pinyin đầu tiên đến khả năng đọc hiểu chuyên sâu, mỗi khóa HSK được
              thiết kế thành các chặng học rõ ràng, có bài luyện và theo dõi tiến độ ngay trên HànNgữ.</p>
            <div class="cm-hero__actions">
              <a class="cm-action cm-action--light" href="#course-list">Xem 6 khóa học <span
                  aria-hidden="true">↓</span></a>
              <?php if (isset($_SESSION['user_id'])): ?>
                <a class="cm-action cm-action--ghost" href="my_courses.php">📚 Khóa của tôi</a>
              <?php else: ?>
                <a class="cm-action cm-action--ghost" href="#study-path">Tìm cấp độ phù hợp</a>
              <?php endif; ?>
            </div>
            <div class="cm-hero__trust" aria-label="Cam kết khóa học">
              <span><b aria-hidden="true">✓</b> Học mọi lúc trên web</span>
              <span><b aria-hidden="true">✓</b> Thanh toán QR an toàn</span>
              <span><b aria-hidden="true">✓</b> Cấp quyền học sau xác nhận</span>
            </div>
          </div>

          <aside class="cm-roadmap" aria-label="Lộ trình từ HSK 1 đến HSK 6">
            <div class="cm-roadmap__head"><span>Hành trình HSK của bạn</span><span>6 cấp độ</span></div>
            <ol class="cm-roadmap__list">
              <li class="cm-roadmap__item cm-roadmap__item--active"><span
                  class="cm-roadmap__number">01</span><span><span class="cm-roadmap__name">HSK 1 · Nền tảng</span><span
                    class="cm-roadmap__caption">Pinyin &amp; giao tiếp đầu tiên</span></span><span
                  class="cm-roadmap__arrow" aria-hidden="true">→</span></li>
              <li class="cm-roadmap__item"><span class="cm-roadmap__number">02</span><span><span
                    class="cm-roadmap__name">HSK 2 · Phản xạ</span><span class="cm-roadmap__caption">Tình huống hằng
                    ngày</span></span><span class="cm-roadmap__arrow" aria-hidden="true">→</span></li>
              <li class="cm-roadmap__item"><span class="cm-roadmap__number">03</span><span><span
                    class="cm-roadmap__name">HSK 3 · Củng cố</span><span class="cm-roadmap__caption">Ngữ pháp &amp; bốn
                    kỹ năng</span></span><span class="cm-roadmap__arrow" aria-hidden="true">→</span></li>
              <li class="cm-roadmap__item"><span class="cm-roadmap__number">04</span><span><span
                    class="cm-roadmap__name">HSK 4–6 · Bứt phá</span><span class="cm-roadmap__caption">Đọc, viết &amp;
                    luyện thi chuyên sâu</span></span><span class="cm-roadmap__arrow" aria-hidden="true">→</span></li>
            </ol>
            <p class="cm-roadmap__foot">Bạn có thể học từng cấp độ theo mục tiêu hiện tại và quay lại ôn luyện bất cứ
              lúc nào.</p>
          </aside>
        </div>

        <div class="cm-proof" aria-label="Điểm nổi bật của khóa học">
          <div class="cm-proof__item"><span class="cm-proof__icon" aria-hidden="true">▣</span><span><strong>06 lộ trình
                HSK</strong><small>Từ người mới đến chuyên sâu</small></span></div>
          <div class="cm-proof__item"><span class="cm-proof__icon" aria-hidden="true">◉</span><span><strong>Học theo mục
                tiêu</strong><small>Bám sát từng kỹ năng cần thiết</small></span></div>
          <div class="cm-proof__item"><span class="cm-proof__icon" aria-hidden="true">↗</span><span><strong>Theo dõi
                tiến độ</strong><small>Xem lại nội dung đã học</small></span></div>
          <div class="cm-proof__item"><span class="cm-proof__icon" aria-hidden="true">⌁</span><span><strong>Hóa đơn điện
                tử</strong><small>Nhận sau khi đơn được xác nhận</small></span></div>
        </div>
      </div>
    </section>

    <section class="cm-section" id="course-list" aria-labelledby="course-list-title">
      <div class="cm-wrap">
        <div class="cm-section__head">
          <div><span class="cm-eyebrow">Chọn cấp độ của bạn</span>
            <h2 id="course-list-title">Sáu khóa học, một hành trình tiến bộ rõ ràng</h2>
          </div>
          <p>Học phí là trọn gói cho từng khóa. Nhấn xem chi tiết để kiểm tra nội dung trước khi tạo đơn và thanh toán
            bằng QR.</p>
        </div>

        <div class="cm-course-grid">
          <article class="cm-course-card" style="--course:#0c9984;--course-soft:#ddf7f0;--course-deep:#075e53">
            <div class="cm-course-cover"><span class="cm-course-cover__track">Khởi đầu</span><span
                class="cm-course-cover__level">HSK 1</span><span class="cm-course-cover__hanzi"
                aria-hidden="true">你</span></div>
            <div class="cm-course-body">
              <span class="cm-course-kicker">Beginner · A1</span>
              <h3>Nền tảng tiếng Trung</h3>
              <p class="cm-course-desc">Bắt đầu từ Pinyin, phát âm chuẩn và những mẫu hội thoại đầu tiên để tự tin giao
                tiếp cơ bản.</p>
              <div class="cm-course-stats">
                <div><strong>30</strong><span>bài học</span></div>
                <div><strong>150+</strong><span>từ mục tiêu</span></div>
                <div><strong>8 tuần</strong><span>lộ trình</span></div>
              </div>
              <ul class="cm-course-includes">
                <li>Pinyin, thanh điệu và chữ Hán nhập môn</li>
                <li>Hội thoại chào hỏi, mua sắm, hỏi đường</li>
                <li>Bài kiểm tra tổng kết cấp độ</li>
              </ul>
              <div class="cm-course-price"><span class="cm-course-price__label">Học phí trọn khóa</span>
                <div class="cm-course-price__row"><strong>1.490.000₫</strong><del>2.000.000₫</del></div><span
                  class="cm-course-price__save">Tiết kiệm 510.000₫</span>
              </div>
              <div class="cm-course-actions"><a class="cm-card-link" href="course.php?slug=hsk-1-nen-tang">Xem lộ
                  trình</a><a class="cm-course-buy" href="course.php?slug=hsk-1-nen-tang">Chọn HSK 1</a></div>
            </div>
          </article>

          <article class="cm-course-card" style="--course:#1886c8;--course-soft:#e0f2ff;--course-deep:#075f98">
            <div class="cm-course-cover"><span class="cm-course-cover__track">Xây phản xạ</span><span
                class="cm-course-cover__level">HSK 2</span><span class="cm-course-cover__hanzi"
                aria-hidden="true">好</span></div>
            <div class="cm-course-body">
              <span class="cm-course-kicker">Elementary · A2</span>
              <h3>Giao tiếp cơ bản</h3>
              <p class="cm-course-desc">Mở rộng vốn từ và phản xạ trong các tình huống đời sống, học tập, công việc quen
                thuộc.</p>
              <div class="cm-course-stats">
                <div><strong>38</strong><span>bài học</span></div>
                <div><strong>300+</strong><span>từ mục tiêu</span></div>
                <div><strong>10 tuần</strong><span>lộ trình</span></div>
              </div>
              <ul class="cm-course-includes">
                <li>Nghe – nói theo ngữ cảnh thường gặp</li>
                <li>Cấu trúc câu và ngữ pháp thiết yếu</li>
                <li>Luyện tập từ vựng, phản xạ hằng ngày</li>
              </ul>
              <div class="cm-course-price"><span class="cm-course-price__label">Học phí trọn khóa</span>
                <div class="cm-course-price__row"><strong>1.790.000₫</strong><del>2.400.000₫</del></div><span
                  class="cm-course-price__save">Tiết kiệm 610.000₫</span>
              </div>
              <div class="cm-course-actions"><a class="cm-card-link" href="course.php?slug=hsk-2-giao-tiep">Xem lộ
                  trình</a><a class="cm-course-buy" href="course.php?slug=hsk-2-giao-tiep">Chọn HSK 2</a></div>
            </div>
          </article>

          <article class="cm-course-card cm-course-card--popular"
            style="--course:#de8a12;--course-soft:#fff2d4;--course-deep:#9b5705">
            <span class="cm-course-card__badge">Được chọn nhiều</span>
            <div class="cm-course-cover"><span class="cm-course-cover__track">Củng cố toàn diện</span><span
                class="cm-course-cover__level">HSK 3</span><span class="cm-course-cover__hanzi"
                aria-hidden="true">学</span></div>
            <div class="cm-course-body">
              <span class="cm-course-kicker">Pre-intermediate · B1</span>
              <h3>Sơ cấp nâng cao</h3>
              <p class="cm-course-desc">Củng cố bốn kỹ năng và ngữ pháp trọng tâm để bạn tự tin giao tiếp, sẵn sàng
                chinh phục HSK 3.</p>
              <div class="cm-course-stats">
                <div><strong>45</strong><span>bài học</span></div>
                <div><strong>600+</strong><span>từ mục tiêu</span></div>
                <div><strong>12 tuần</strong><span>lộ trình</span></div>
              </div>
              <ul class="cm-course-includes">
                <li>Nghe, đọc và cấu trúc ngữ pháp trọng tâm</li>
                <li>Bài luyện theo từng chủ điểm HSK 3</li>
                <li>Đề tự luyện và kiểm tra tiến độ</li>
              </ul>
              <div class="cm-course-price"><span class="cm-course-price__label">Học phí trọn khóa</span>
                <div class="cm-course-price__row"><strong>2.190.000₫</strong><del>3.000.000₫</del></div><span
                  class="cm-course-price__save">Tiết kiệm 810.000₫</span>
              </div>
              <div class="cm-course-actions"><a class="cm-card-link" href="course.php?slug=hsk-3-so-cap">Xem lộ
                  trình</a><a class="cm-course-buy" href="course.php?slug=hsk-3-so-cap">Chọn HSK 3</a></div>
            </div>
          </article>

          <article class="cm-course-card" style="--course:#7c57c9;--course-soft:#eee9ff;--course-deep:#52369a">
            <div class="cm-course-cover"><span class="cm-course-cover__track">Giao tiếp độc lập</span><span
                class="cm-course-cover__level">HSK 4</span><span class="cm-course-cover__hanzi"
                aria-hidden="true">说</span></div>
            <div class="cm-course-body">
              <span class="cm-course-kicker">Intermediate · B2</span>
              <h3>Trung cấp toàn diện</h3>
              <p class="cm-course-desc">Tăng tốc khả năng diễn đạt, đọc hiểu và viết đoạn văn trong những chủ đề học
                tập, xã hội quen thuộc.</p>
              <div class="cm-course-stats">
                <div><strong>48</strong><span>bài học</span></div>
                <div><strong>1.200+</strong><span>từ mục tiêu</span></div>
                <div><strong>16 tuần</strong><span>lộ trình</span></div>
              </div>
              <ul class="cm-course-includes">
                <li>Ngữ pháp trung cấp và mẫu diễn đạt tự nhiên</li>
                <li>Đọc hiểu, viết đoạn và nghe theo ngữ cảnh</li>
                <li>Chuyên đề ôn luyện HSK 4</li>
              </ul>
              <div class="cm-course-price"><span class="cm-course-price__label">Học phí trọn khóa</span>
                <div class="cm-course-price__row"><strong>2.790.000₫</strong><del>4.500.000₫</del></div><span
                  class="cm-course-price__save">Tiết kiệm 1.710.000₫</span>
              </div>
              <div class="cm-course-actions"><a class="cm-card-link" href="course.php?slug=hsk-4-trung-cap">Xem lộ
                  trình</a><a class="cm-course-buy" href="course.php?slug=hsk-4-trung-cap">Chọn HSK 4</a></div>
            </div>
          </article>

          <article class="cm-course-card" style="--course:#ce4277;--course-soft:#ffe6f0;--course-deep:#95264f">
            <div class="cm-course-cover"><span class="cm-course-cover__track">Nâng cao ứng dụng</span><span
                class="cm-course-cover__level">HSK 5</span><span class="cm-course-cover__hanzi"
                aria-hidden="true">读</span></div>
            <div class="cm-course-body">
              <span class="cm-course-kicker">Upper-intermediate · C1</span>
              <h3>Chinh phục HSK 5</h3>
              <p class="cm-course-desc">Luyện đọc văn bản dài, viết có lập luận và ứng dụng tiếng Trung linh hoạt trong
                học tập, công việc.</p>
              <div class="cm-course-stats">
                <div><strong>54</strong><span>bài học</span></div>
                <div><strong>2.500+</strong><span>từ mục tiêu</span></div>
                <div><strong>20 tuần</strong><span>lộ trình</span></div>
              </div>
              <ul class="cm-course-includes">
                <li>Đọc báo, phân tích văn bản và từ học thuật</li>
                <li>Viết đoạn, bài luận theo các chủ đề phổ biến</li>
                <li>Bộ đề luyện và chiến lược ôn HSK 5</li>
              </ul>
              <div class="cm-course-price"><span class="cm-course-price__label">Học phí trọn khóa</span>
                <div class="cm-course-price__row"><strong>3.490.000₫</strong><del>4.800.000₫</del></div><span
                  class="cm-course-price__save">Tiết kiệm 1.310.000₫</span>
              </div>
              <div class="cm-course-actions"><a class="cm-card-link" href="course.php?slug=hsk-5-nang-cao">Xem lộ
                  trình</a><a class="cm-course-buy" href="course.php?slug=hsk-5-nang-cao">Chọn HSK 5</a></div>
            </div>
          </article>

          <article class="cm-course-card" style="--course:#d34b46;--course-soft:#ffe8e5;--course-deep:#9c2e2b">
            <div class="cm-course-cover"><span class="cm-course-cover__track">Làm chủ chuyên sâu</span><span
                class="cm-course-cover__level">HSK 6</span><span class="cm-course-cover__hanzi"
                aria-hidden="true">赢</span></div>
            <div class="cm-course-body">
              <span class="cm-course-kicker">Advanced · C2</span>
              <h3>Luyện thi HSK 6</h3>
              <p class="cm-course-desc">Phát triển tư duy ngôn ngữ, đọc hiểu chuyên sâu và chiến lược xử lý các dạng bài
                khó của HSK 6.</p>
              <div class="cm-course-stats">
                <div><strong>60</strong><span>bài học</span></div>
                <div><strong>5.000+</strong><span>từ mục tiêu</span></div>
                <div><strong>24 tuần</strong><span>lộ trình</span></div>
              </div>
              <ul class="cm-course-includes">
                <li>Văn bản chuyên sâu và sắc thái diễn đạt</li>
                <li>Luyện nghe – đọc – viết ở độ khó cao</li>
                <li>Đề mô phỏng cùng chiến thuật làm bài</li>
              </ul>
              <div class="cm-course-price"><span class="cm-course-price__label">Học phí trọn khóa</span>
                <div class="cm-course-price__row"><strong>4.290.000₫</strong><del>6.000.000₫</del></div><span
                  class="cm-course-price__save">Tiết kiệm 1.710.000₫</span>
              </div>
              <div class="cm-course-actions"><a class="cm-card-link" href="course.php?slug=hsk-6-chuyen-sau">Xem lộ
                  trình</a><a class="cm-course-buy" href="course.php?slug=hsk-6-chuyen-sau">Chọn HSK 6</a></div>
            </div>
          </article>
        </div>
        <p class="cm-note"><b aria-hidden="true">i</b> Giá hiển thị là học phí trọn khóa; nội dung và quyền học sẽ được
          mở sau khi thanh toán được xác nhận.</p>
      </div>
    </section>

    <section class="cm-section cm-section--tight" id="study-path" aria-labelledby="study-path-title">
      <div class="cm-wrap">
        <div class="cm-section__head">
          <div><span class="cm-eyebrow">Chưa biết nên học từ đâu?</span>
            <h2 id="study-path-title">Chọn theo điểm xuất phát của bạn</h2>
          </div>
          <p>Không cần mua cả lộ trình cùng lúc. Bắt đầu từ cấp phù hợp nhất, sau đó tiếp tục lên cấp kế tiếp khi đã sẵn
            sàng.</p>
        </div>
        <div class="cm-path-grid">
          <a class="cm-route-card" data-hanzi="初" style="--route:#0b8f7e;--route-soft:#dff6f0"
            href="course.php?slug=hsk-1-nen-tang"><span class="cm-route-card__step">01</span>
            <h3>Chưa từng học tiếng Trung</h3>
            <p>Bạn cần Pinyin, cách phát âm, chữ Hán cơ bản và những câu giao tiếp đầu tiên.</p><span
              class="cm-route-card__link">Bắt đầu với HSK 1 <span aria-hidden="true">→</span></span>
          </a>
          <a class="cm-route-card" data-hanzi="进" style="--route:#9d6705;--route-soft:#fff1d5"
            href="course.php?slug=hsk-3-so-cap"><span class="cm-route-card__step">02</span>
            <h3>Đã biết nền tảng, muốn vững hơn</h3>
            <p>Bạn đã có từ vựng cơ bản và muốn giao tiếp tốt hơn hoặc chuẩn bị thi HSK 3.</p><span
              class="cm-route-card__link">Khám phá HSK 3 <span aria-hidden="true">→</span></span>
          </a>
          <a class="cm-route-card" data-hanzi="成" style="--route:#7a4bbc;--route-soft:#eee8ff"
            href="course.php?slug=hsk-5-nang-cao"><span class="cm-route-card__step">03</span>
            <h3>Muốn dùng tiếng Trung chuyên sâu</h3>
            <p>Bạn muốn đọc, viết và dùng tiếng Trung trong học tập, công việc hoặc mục tiêu chứng chỉ cao hơn.</p><span
              class="cm-route-card__link">Xem HSK 5–6 <span aria-hidden="true">→</span></span>
          </a>
        </div>
      </div>
    </section>

    <section class="cm-section cm-section--tight" aria-labelledby="compare-title">
      <div class="cm-wrap">
        <div class="cm-section__head">
          <div><span class="cm-eyebrow">So sánh nhanh</span>
            <h2 id="compare-title">Tổng quan lộ trình HSK 1–6</h2>
          </div>
          <p>Thời lượng là lộ trình gợi ý khi bạn học đều đặn. Bạn vẫn có thể học theo tốc độ riêng trên hệ thống.</p>
        </div>
        <div class="cm-compare">
          <div class="cm-compare__scroll">
            <table>
              <caption>Bảng so sánh sáu khóa học tiếng Trung HSK</caption>
              <thead>
                <tr>
                  <th>Khóa học</th>
                  <th>Phù hợp khi</th>
                  <th>Nội dung</th>
                  <th>Từ vựng mục tiêu</th>
                  <th>Lộ trình gợi ý</th>
                  <th>Học phí</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>HSK 1</strong><small>Nền tảng</small></td>
                  <td>Mới bắt đầu</td>
                  <td>30 bài</td>
                  <td>150+</td>
                  <td>8 tuần</td>
                  <td><strong>1.490.000₫</strong></td>
                  <td><a class="cm-table-link" href="course.php?slug=hsk-1-nen-tang">Xem khóa →</a></td>
                </tr>
                <tr>
                  <td><strong>HSK 2</strong><small>Giao tiếp cơ bản</small></td>
                  <td>Đã biết Pinyin</td>
                  <td>38 bài</td>
                  <td>300+</td>
                  <td>10 tuần</td>
                  <td><strong>1.790.000₫</strong></td>
                  <td><a class="cm-table-link" href="course.php?slug=hsk-2-giao-tiep">Xem khóa →</a></td>
                </tr>
                <tr>
                  <td><strong>HSK 3</strong><small>Sơ cấp nâng cao</small></td>
                  <td>Muốn vững 4 kỹ năng</td>
                  <td>45 bài</td>
                  <td>600+</td>
                  <td>12 tuần</td>
                  <td><strong>2.190.000₫</strong></td>
                  <td><a class="cm-table-link" href="course.php?slug=hsk-3-so-cap">Xem khóa →</a></td>
                </tr>
                <tr>
                  <td><strong>HSK 4</strong><small>Trung cấp</small></td>
                  <td>Muốn diễn đạt độc lập</td>
                  <td>48 bài</td>
                  <td>1.200+</td>
                  <td>16 tuần</td>
                  <td><strong>2.790.000₫</strong></td>
                  <td><a class="cm-table-link" href="course.php?slug=hsk-4-trung-cap">Xem khóa →</a></td>
                </tr>
                <tr>
                  <td><strong>HSK 5</strong><small>Nâng cao</small></td>
                  <td>Học tập &amp; công việc</td>
                  <td>54 bài</td>
                  <td>2.500+</td>
                  <td>20 tuần</td>
                  <td><strong>3.490.000₫</strong></td>
                  <td><a class="cm-table-link" href="course.php?slug=hsk-5-nang-cao">Xem khóa →</a></td>
                </tr>
                <tr>
                  <td><strong>HSK 6</strong><small>Chuyên sâu</small></td>
                  <td>Mục tiêu trình độ cao</td>
                  <td>60 bài</td>
                  <td>5.000+</td>
                  <td>24 tuần</td>
                  <td><strong>4.290.000₫</strong></td>
                  <td><a class="cm-table-link" href="course.php?slug=hsk-6-chuyen-sau">Xem khóa →</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <section class="cm-section cm-section--tight" aria-labelledby="payment-title">
      <div class="cm-wrap">
        <div class="cm-steps">
          <div>
            <span class="cm-eyebrow">Mua khóa học đơn giản</span>
            <h2 id="payment-title">Chọn khóa, quét QR và bắt đầu học</h2>
            <p class="cm-steps__intro">Khi nhấn chọn khóa học, bạn sẽ xem được trang chi tiết và tạo đơn thanh toán. Mã
              QR hiển thị đúng số tiền cùng mã đơn để việc đối soát rõ ràng hơn.</p>
            <div class="cm-steps__points">
              <div class="cm-steps__point"><span>1</span><strong>Chọn khóa học</strong>
                <p>Xem nội dung và học phí.</p>
              </div>
              <div class="cm-steps__point"><span>2</span><strong>Quét mã QR</strong>
                <p>Thanh toán theo mã đơn riêng.</p>
              </div>
              <div class="cm-steps__point"><span>3</span><strong>Nhận quyền học</strong>
                <p>Mở khóa sau khi xác nhận.</p>
              </div>
            </div>
          </div>
          <div class="cm-steps__receipt" aria-label="Minh họa hóa đơn điện tử">
            <div class="cm-receipt">
              <div class="cm-receipt__brand"><span>HÀNNGỮ</span><span>HÓA ĐƠN ĐIỆN TỬ</span></div>
              <h3>Khóa học tiếng Trung HSK</h3>
              <p>Sau khi thanh toán được xác nhận, bạn có thể xem lịch sử đơn hàng và nhận hóa đơn qua email nếu đã cấu
                hình.</p>
              <div class="cm-receipt__amount"><span>Thanh toán</span><strong>QR MB Bank</strong></div>
              <div class="cm-receipt__ok"><b aria-hidden="true">✓</b> Quyền học được cấp theo đơn hàng</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cm-section cm-section--tight" aria-labelledby="faq-title">
      <div class="cm-wrap cm-faq">
        <div class="cm-faq__intro"><span class="cm-eyebrow">Câu hỏi thường gặp</span>
          <h2 id="faq-title">Bạn cần biết trước khi đăng ký</h2>
          <p>Những thông tin cơ bản về quyền học và quy trình thanh toán cho các khóa HSK trên HànNgữ.</p>
        </div>
        <div class="cm-faq-list">
          <details open>
            <summary>Mua xong tôi học khóa học ở đâu?</summary>
            <p>Sau khi thanh toán được xác nhận, tài khoản của bạn được cấp quyền vào khóa học tương ứng. Bạn có thể mở
              lại trang khóa học hoặc xem đơn hàng của mình để tiếp tục học.</p>
          </details>
          <details>
            <summary>Tôi có cần mua toàn bộ HSK 1 đến HSK 6 không?</summary>
            <p>Không. Mỗi khóa được bán riêng để bạn chọn đúng cấp độ hiện tại. Nếu mới bắt đầu, nên đi từ HSK 1; nếu đã
              có nền tảng, hãy chọn cấp phù hợp với mục tiêu của bạn.</p>
          </details>
          <details>
            <summary>Thanh toán QR có an toàn không?</summary>
            <p>Mã QR được tạo theo đơn hàng với số tiền và mã nội dung riêng. Hệ thống chỉ cấp quyền học khi trạng thái
              đơn đã được xác nhận thanh toán.</p>
          </details>
          <details>
            <summary>Tôi có nhận được hóa đơn không?</summary>
            <p>Sau khi đơn được xác nhận, hệ thống tạo hóa đơn điện tử cho đơn hàng. Nếu cấu hình email đã hoàn tất, hóa
              đơn cũng được gửi đến địa chỉ email của tài khoản.</p>
          </details>
        </div>
      </div>
    </section>

    <section class="cm-final">
      <div class="cm-wrap">
        <div class="cm-final__box"><span class="cm-eyebrow">Bắt đầu hôm nay</span>
          <h2>Tiếng Trung không còn là một mục tiêu mơ hồ</h2>
          <p>Chọn cấp độ phù hợp, tạo thói quen học đều và tiến từng bước trên lộ trình của riêng bạn.</p><a
            class="cm-action" href="#course-list">Chọn khóa học phù hợp <span aria-hidden="true">↑</span></a>
        </div>
      </div>
    </section>
  </main>
</body>

</html>