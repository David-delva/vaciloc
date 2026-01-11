<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Connexion Admin') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
        }
        .avatar-circle {
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .input-group-text {
            background: #f3f4f6;
            border: 2px solid #e5e7eb;
            border-right: none;
        }
        .form-control {
            border: 2px solid #e5e7eb;
            border-left: none;
            padding: 0.75rem 1rem;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 1rem;
            font-weight: 700;
            font-size: 1.1rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <div class="login-card">
                    <div class="login-header">
                        <div class="avatar-circle">
                            <i class="fas fa-user-shield fa-3x"></i>
                        </div>
                        <h3 style="font-weight: 800; margin-bottom: 0.5rem; letter-spacing: -0.02em;">VACILOC</h3>
                        <p style="opacity: 0.9; margin: 0; font-size: 0.95rem;">Panneau d'administration</p>
                    </div>
                    
                    <div class="card-body" style="padding: 2.5rem 2rem;">
                        <?php if (isset($error)): ?>
                            <div class="alert" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; border: none; border-left: 4px solid #ef4444; border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                                <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-4">
                                <label for="username" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                    <i class="fas fa-user me-1" style="color: #667eea;"></i>
                                    Nom d'utilisateur
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user" style="color: #6b7280;"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required autofocus>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                    <i class="fas fa-lock me-1" style="color: #667eea;"></i>
                                    Mot de passe
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock" style="color: #6b7280;"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-login w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <a href="/" style="color: #667eea; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s;" onmouseover="this.style.gap='0.75rem'" onmouseout="this.style.gap='0.5rem'">
                                <i class="fas fa-arrow-left"></i>
                                Retour au site
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p style="color: rgba(255,255,255,0.9); font-size: 0.875rem; margin: 0;">
                        <i class="fas fa-shield-alt me-1"></i>
                        Connexion sécurisée
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>