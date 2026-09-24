<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Task Tracker' }} · Task Tracker</title>
    <style>
        :root { --blue: #1067D1; --sky: #C2DEFF; --ink: #132238; --muted: #65758b; --line: #e2ebf4; --paper: #f7fbff; --white: #fff; --green: #188a5b; }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        a { color: inherit; text-decoration: none; }
        button, input, textarea, select { font: inherit; }
        .shell { min-height: 100vh; background: radial-gradient(circle at 85% 0%, #e4f1ff 0, transparent 32%), var(--paper); }
        .nav { display: flex; align-items: center; justify-content: space-between; max-width: 1180px; margin: auto; padding: 26px 28px; }
        .brand { display: flex; gap: 11px; align-items: center; font-weight: 800; font-size: 20px; letter-spacing: -.5px; }
        .brand-mark { display: grid; width: 34px; height: 34px; place-items: center; border-radius: 10px; color: white; background: var(--blue); box-shadow: 0 7px 14px #1067d132; }
        .nav-link { color: var(--muted); font-size: 14px; font-weight: 700; }
        .container { max-width: 1180px; margin: auto; padding: 40px 28px 80px; }
        .eyebrow { color: var(--blue); font-size: 12px; font-weight: 800; letter-spacing: 1.7px; text-transform: uppercase; }
        h1 { margin: 10px 0 8px; font-size: clamp(32px, 5vw, 54px); letter-spacing: -2.8px; line-height: 1; }
        h2 { margin: 0; font-size: 21px; letter-spacing: -.6px; }
        .subtitle { color: var(--muted); margin: 0; font-size: 16px; }
        .topline { display: flex; justify-content: space-between; gap: 20px; align-items: end; margin-bottom: 38px; }
        .button { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 17px; border: 0; border-radius: 9px; background: var(--blue); color: white; font-weight: 750; cursor: pointer; box-shadow: 0 8px 18px #1067d124; }
        .button:hover { background: #095bbd; }
        .button.secondary { background: #eaf4ff; color: var(--blue); box-shadow: none; }
        .button.danger { background: #fff0f0; color: #c73535; box-shadow: none; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 28px; }
        .stat { background: white; border: 1px solid var(--line); border-radius: 14px; padding: 19px 20px; }
        .stat-label { color: var(--muted); font-size: 13px; font-weight: 700; }
        .stat-number { display: block; margin-top: 8px; font-size: 30px; font-weight: 800; letter-spacing: -1px; }
        .stat:nth-child(2) .stat-number { color: var(--blue); }
        .stat:nth-child(3) .stat-number { color: var(--green); }
        .panel { background: white; border: 1px solid var(--line); border-radius: 16px; overflow: hidden; }
        .panel-head { display: flex; justify-content: space-between; align-items: center; padding: 22px 24px; border-bottom: 1px solid var(--line); }
        .task-list { list-style: none; padding: 0; margin: 0; }
        .task { display: grid; grid-template-columns: 26px 1fr auto; gap: 15px; align-items: start; padding: 21px 24px; border-bottom: 1px solid #edf2f7; }
        .task:last-child { border-bottom: 0; }
        .check { width: 20px; height: 20px; margin-top: 1px; accent-color: var(--blue); cursor: pointer; }
        .task-title { font-weight: 750; font-size: 16px; }
        .task.done .task-title { color: #93a0ae; text-decoration: line-through; }
        .task-description { margin: 5px 0 0; color: var(--muted); font-size: 13px; line-height: 1.45; }
        .task-meta { display: flex; gap: 12px; align-items: center; margin-top: 10px; color: var(--muted); font-size: 12px; }
        .badge { border-radius: 99px; padding: 5px 9px; color: var(--blue); background: #eaf4ff; font-size: 11px; font-weight: 800; text-transform: uppercase; }
        .badge.done { color: var(--green); background: #e4f6ee; }
        .actions { display: flex; gap: 8px; align-items: center; }
        .icon-link { padding: 7px; color: var(--muted); font-size: 13px; font-weight: 700; }
        .empty { padding: 55px 20px; color: var(--muted); text-align: center; }
        .empty strong { display: block; color: var(--ink); margin-bottom: 7px; font-size: 17px; }
        .form-wrap { max-width: 670px; margin: 10px auto; }
        .form-panel { background: white; border: 1px solid var(--line); border-radius: 16px; padding: 30px; }
        .form-grid { display: grid; gap: 19px; margin-top: 26px; }
        label { display: grid; gap: 8px; color: var(--ink); font-size: 13px; font-weight: 750; }
        input, textarea, select { width: 100%; border: 1px solid #cfdeec; border-radius: 8px; padding: 12px 13px; color: var(--ink); background: white; outline: none; }
        textarea { min-height: 125px; resize: vertical; }
        input:focus, textarea:focus, select:focus { border-color: var(--blue); box-shadow: 0 0 0 3px #c2deff88; }
        .form-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 6px; }
        .alert { max-width: 1180px; margin: 0 auto; padding: 0 28px; }
        .alert-inner { padding: 12px 15px; border-radius: 8px; background: #e4f6ee; color: var(--green); font-size: 13px; font-weight: 700; }
        .errors { margin: 0; padding: 12px 15px; border-radius: 8px; background: #fff0f0; color: #c73535; font-size: 13px; }
        @media (max-width: 650px) { .nav, .container { padding-left: 18px; padding-right: 18px; } .topline { align-items: start; flex-direction: column; } .stats { gap: 8px; } .stat { padding: 15px 12px; } .stat-number { font-size: 25px; } .task { grid-template-columns: 25px 1fr; padding: 18px; } .actions { grid-column: 2; } .panel-head { padding: 18px; } .form-panel { padding: 22px; } }
    </style>
</head>
<body>
<div class="shell">
    <nav class="nav">
        <a class="brand" href="{{ route('tasks.index', [], false) }}"><span class="brand-mark">✓</span> Task Tracker</a>
        <a class="nav-link" href="{{ route('tasks.index', [], false) }}">My workspace</a>
    </nav>
    @if(session('success')) <div class="alert"><div class="alert-inner">{{ session('success') }}</div></div> @endif
    @yield('content')
</div>
</body>
</html>