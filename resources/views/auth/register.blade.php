@extends('adminlte::master')

@section('adminlte_css')
<style>
	body {
		background: #f5f3ff;
		font-family: 'Inter', 'Segoe UI', sans-serif;
	}

	.auth-shell {
		min-height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 24px;
	}

	.auth-card {
		width: 100%;
		max-width: 980px;
		background: #ffffff;
		border-radius: 16px;
		overflow: hidden;
		box-shadow: 0 24px 60px rgba(74, 58, 255, 0.15);
		display: grid;
		grid-template-columns: 1.05fr 0.95fr;
	}

	.auth-visual {
		background: linear-gradient(135deg, #8a5cf6 0%, #7c4dff 50%, #a06cf6 100%);
		color: #fff;
		padding: 48px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		gap: 18px;
	}

	.auth-visual .brand-mark {
		display: inline-flex;
		align-items: center;
		gap: 12px;
		font-size: 26px;
		font-weight: 700;
	}

	.auth-visual .brand-mark .icon {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 42px;
		height: 42px;
		border-radius: 12px;
		background: rgba(255, 255, 255, 0.18);
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.35);
	}

	.auth-visual h2 {
		font-size: 28px;
		margin: 0;
	}

	.auth-visual p {
		margin: 0;
		color: rgba(255, 255, 255, 0.9);
	}

	.auth-form {
		padding: 48px;
	}

	.auth-form h1 {
		font-size: 26px;
		font-weight: 700;
		margin-bottom: 8px;
		color: #1f2233;
	}

	.auth-form .subtext {
		color: #6b7280;
		margin-bottom: 24px;
	}

	.form-control {
		border-radius: 10px;
		padding: 12px 14px;
		border: 1px solid #e5e7eb;
	}

	.form-control:focus {
		border-color: #8a5cf6;
		box-shadow: 0 0 0 3px rgba(138, 92, 246, 0.18);
	}

	.btn-primary {
		background: linear-gradient(135deg, #8a5cf6 0%, #7c4dff 100%);
		border: none;
		border-radius: 10px;
		padding: 12px;
		font-weight: 600;
		box-shadow: 0 12px 30px rgba(138, 92, 246, 0.35);
	}

	.btn-primary:hover {
		filter: brightness(1.02);
	}

	.link-muted {
		color: #6b7280;
	}

	.link-muted:hover {
		color: #7c4dff;
		text-decoration: none;
	}

	@media (max-width: 900px) {
		.auth-card {
			grid-template-columns: 1fr;
		}
		.auth-visual {
			padding: 36px;
		}
		.auth-form {
			padding: 32px;
		}
	}
</style>
@stop

@section('body')
<div class="auth-shell">
	<div class="auth-card">
		<div class="auth-visual">
			<div class="brand-mark">
				<span class="icon"><i class="fas fa-spa"></i></span>
				<span>Glow Skincare</span>
			</div>
			<h2>Create your account</h2>
			<p class="mb-1" style="font-weight:600; font-size:17px;">The Glow Promise</p>
			<p>Committed to clean beauty, dermatologist-tested formulas, and transparent ingredients—so you shop with confidence.</p>
			<ul class="bullet-list text-white" style="padding-left:20px; margin-top:8px;">
				<li>Clinically guided, skin-safe formulations</li>
				<li>Full ingredient transparency, no surprises</li>
				<li>Fast delivery with easy, hassle-free returns</li>
			</ul>
			<p class="mb-0">Already have an account? <a class="text-white" href="{{ route('login') }}">Sign in</a></p>
		</div>
		<div class="auth-form">
			<h1>Sign up</h1>
			<div class="subtext">Set up your admin access to Glow Skincare.</div>

			<form method="POST" action="{{ route('register') }}">
				@csrf

				<div class="form-group mb-3">
					<label class="font-weight-semibold">Full name</label>
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Alex Doe">
					@error('name')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
					@enderror
				</div>

				<div class="form-group mb-3">
					<label class="font-weight-semibold">Email</label>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
					@error('email')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
					@enderror
				</div>

				<div class="form-group mb-3">
					<label class="font-weight-semibold">Password</label>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="••••••••">
					@error('password')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
					@enderror
				</div>

				<div class="form-group mb-4">
					<label class="font-weight-semibold">Confirm password</label>
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="••••••••">
				</div>

				<button type="submit" class="btn btn-primary btn-block">Create account</button>
			</form>

			<div class="mt-4 text-center link-muted">
				By creating an account you agree to our terms and privacy policy.
			</div>
		</div>
	</div>
</div>
@stop