@extends('dashboard.auth.layout')
@section('title', 'Start your free trial')
@section('content')
  <p style="font-size:12px;letter-spacing:.08em;text-transform:uppercase;font-weight:700;color:var(--accent)">Step 1 of 3</p>
  <h1>Start your {{ $days }}-day free trial</h1>
  <p>Your ads, store, analytics and CRM in one dashboard. No card needed.</p>
  <form method="post" action="{{ route('signup.store') }}" autocomplete="on">
    @csrf
    <div style="position:absolute;left:-5000px" aria-hidden="true"><label>Website <input type="text" name="website_url" tabindex="-1" autocomplete="off"></label></div>
    <label for="name">Your name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="100" autocomplete="name" autofocus>
    @error('name')<div class="err">{{ $message }}</div>@enderror
    <label for="company">Business or brand</label>
    <input id="company" type="text" name="company" value="{{ old('company') }}" required maxlength="90" autocomplete="organization">
    @error('company')<div class="err">{{ $message }}</div>@enderror
    <label for="email">Work email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required maxlength="190" autocomplete="email">
    @error('email')<div class="err">{{ $message }}</div>@enderror
    <label for="password">Password <span style="font-weight:400;color:var(--ink-2)">(12+ characters, letters and numbers)</span></label>
    <input id="password" type="password" name="password" required minlength="12" maxlength="200" autocomplete="new-password">
    @error('password')<div class="err">{{ $message }}</div>@enderror
    <input type="hidden" name="country" id="country" value="{{ old('country') }}">
    <label class="row" style="align-items:flex-start"><input type="checkbox" name="terms" value="1" {{ old('terms') ? 'checked' : '' }} style="margin-top:3px">
      <span>I agree to the <a href="https://laghavi.site/terms-conditions/" target="_blank" rel="noopener">terms</a> and <a href="https://laghavi.site/privacy-policy-2/" target="_blank" rel="noopener">privacy policy</a>.</span></label>
    @error('terms')<div class="err">{{ $message }}</div>@enderror
    <button class="btn">Continue</button>
  </form>
  <p style="margin-top:14px;font-size:13px">Next we send a code to your email, then confirm your WhatsApp number. Already have an account? <a href="{{ route('login') }}">Log in</a></p>
  <p style="font-size:12px">Market &amp; SEO scans, competitor tracking and automations aren't part of the free trial — ask us and we'll switch them on.</p>
  <script>
  try { var tz = Intl.DateTimeFormat().resolvedOptions().timeZone || ''; var m = {'Asia/Dubai':'AE','Asia/Kolkata':'IN','Asia/Calcutta':'IN','Asia/Riyadh':'SA','Asia/Qatar':'QA','Asia/Kuwait':'KW','Asia/Bahrain':'BH','Asia/Muscat':'OM','Europe/London':'GB','America/New_York':'US','America/Chicago':'US','America/Denver':'US','America/Los_Angeles':'US','Australia/Sydney':'AU','Asia/Singapore':'SG'}; var c = document.getElementById('country'); if (!c.value && m[tz]) c.value = m[tz]; } catch (e) {}
  </script>
@endsection
