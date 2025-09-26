<?php
session_start();
if($_SESSION['level']==""){
  header("location:index.php?pesan=gagal");
  } 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="../img/wk.png" sizes="32x32" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin Modern</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --card-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            --hover-shadow: 0 20px 40px rgba(50, 50, 93, 0.2), 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .shape:nth-child(2) { width: 120px; height: 120px; top: 20%; right: 15%; animation-delay: 2s; }
        .shape:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 20%; animation-delay: 4s; }
        .shape:nth-child(4) { width: 100px; height: 100px; bottom: 15%; right: 10%; animation-delay: 1s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Header */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 600;
            color: #667eea !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #667eea !important;
            font-weight: 500;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
        }

        /* Main Content */
        .main-container {
            padding: 2rem 0;
            position: relative;
            z-index: 1;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 3rem;
            color: white;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.2s both;
        }

        /* Card Grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .dashboard-card:nth-child(1) { animation-delay: 0.1s; }
        .dashboard-card:nth-child(2) { animation-delay: 0.2s; }
        .dashboard-card:nth-child(3) { animation-delay: 0.3s; }
        .dashboard-card:nth-child(4) { animation-delay: 0.4s; }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            transition: all 0.3s ease;
        }

        .dashboard-card:nth-child(2)::before { background: var(--secondary-gradient); }
        .dashboard-card:nth-child(3)::before { background: var(--success-gradient); }
        .dashboard-card:nth-child(4)::before { background: var(--warning-gradient); }

        .dashboard-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }

        .dashboard-card:hover::before {
            height: 8px;
        }

        .card-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            background: var(--primary-gradient);
        }

        .dashboard-card:nth-child(2) .card-icon { background: var(--secondary-gradient); }
        .dashboard-card:nth-child(3) .card-icon { background: var(--success-gradient); }
        .dashboard-card:nth-child(4) .card-icon { background: var(--warning-gradient); }

        .dashboard-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 0.5rem;
        }

        .card-description {
            color: #636e72;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .card-action {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card:nth-child(2) .card-action { background: var(--secondary-gradient); }
        .dashboard-card:nth-child(3) .card-action { background: var(--success-gradient); }
        .dashboard-card:nth-child(4) .card-action { background: var(--warning-gradient); }

        .card-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .card-action::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }

        .card-action:hover::before {
            width: 300px;
            height: 300px;
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 500px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #636e72;
            transition: all 0.3s ease;
            padding: 8px 12px;
            border-radius: 12px;
            position: relative;
        }

        .nav-item:hover, .nav-item.active {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .nav-item i {
            font-size: 1.5rem;
            margin-bottom: 4px;
            transition: all 0.3s ease;
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }

        .nav-item span {
            font-size: 0.75rem;
            font-weight: 500;
        }

        .nav-item.center {
            background: var(--primary-gradient);
            color: white;
            padding: 12px;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            margin-top: -20px;
        }

        .nav-item.center:hover {
            transform: translateY(-5px) scale(1.05);
            background: var(--secondary-gradient);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }
            
            .card-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 0 0.5rem;
            }
            
            .dashboard-card {
                padding: 1.5rem;
            }
            
            .main-container {
                padding-bottom: 100px;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-crown"></i>
                Dashboard Admin
            </a>
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <span><?php echo $_SESSION['username']; ?></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container" style="margin-top: 80px;">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="welcome-title">Selamat Datang, Admin! 👋</h1>
            <p class="welcome-subtitle">Kelola sistem Anda dengan mudah dan efisien</p>
        </div>

        <!-- Dashboard Cards -->
        <div class="card-grid">
            <!-- Data Akun Pegawai -->
            <div class="dashboard-card" onclick="handleCardClick('pegawai')">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="card-title">Data Akun Pegawai</h3>
                <p class="card-description">Kelola dan pantau semua akun pegawai dalam sistem Anda dengan fitur lengkap.</p>
                <a href="#" class="card-action">
                    <span>Lihat Data</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Data Akun Pembeli -->
            <div class="dashboard-card" onclick="handleCardClick('pembeli')">
                <div class="card-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h3 class="card-title">Data Akun Pembeli</h3>
                <p class="card-description">Akses informasi lengkap tentang pelanggan dan riwayat pembelian mereka.</p>
                <a href="#" class="card-action">
                    <span>Lihat Data</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Rekap Penjualan -->
            <div class="dashboard-card" onclick="handleCardClick('penjualan')">
                <div class="card-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="card-title">Rekap Penjualan</h3>
                <p class="card-description">Analisis laporan penjualan dengan grafik dan statistik yang detail.</p>
                <a href="#" class="card-action">
                    <span>Lihat Rekap</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Input Data Pegawai -->
            <div class="dashboard-card" onclick="handleCardClick('input')">
                <div class="card-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="card-title">Input Data Pegawai</h3>
                <p class="card-description">Tambahkan pegawai baru ke sistem dengan formulir yang mudah digunakan.</p>
                <a href="crud_pegawai.php" class="card-action">
                    <span>Tambah Pegawai</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Card Click Handler dengan Loading Animation
        function handleCardClick(type) {
            const card = event.currentTarget;
            const button = card.querySelector('.card-action span');
            const originalText = button.textContent;
            
            // Add loading state
            button.innerHTML = originalText + '<span class="loading"></span>';
            card.style.pointerEvents = 'none';
            
            // Simulate loading
            setTimeout(() => {
                button.textContent = originalText;
                card.style.pointerEvents = 'auto';
                
                // Here you would normally navigate to the appropriate page
                switch(type) {
                    case 'pegawai':
                        showNotification('Membuka Data Pegawai...', 'info');
                        break;
                    case 'pembeli':
                        showNotification('Membuka Data Pembeli...', 'info');
                        break;
                    case 'penjualan':
                        showNotification('Membuka Rekap Penjualan...', 'info');
                        break;
                    case 'input':
                        showNotification('Membuka Form Input...', 'success');
                        break;
                }
            }, 1000);
        }

        // Notification System
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'info' ? 'primary' : 'success'} position-fixed`;
            notification.style.cssText = `
                top: 100px; 
                right: 20px; 
                z-index: 9999; 
                min-width: 300px;
                animation: slideIn 0.3s ease;
                border-radius: 10px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            `;
            notification.innerHTML = `
                <i class="fas fa-${type === 'info' ? 'info-circle' : 'check-circle'} me-2"></i>
                ${message}
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Add CSS for notifications
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 2px 30px rgba(0, 0, 0, 0.15)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            }
        });

        // Add hover sound effect (optional)
        document.querySelectorAll('.dashboard-card, .nav-item, .card-action').forEach(element => {
            element.addEventListener('mouseenter', () => {
                // Optional: Add subtle sound effect here
                element.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            });
        });

        // Welcome message based on time
        const hour = new Date().getHours();
        const welcomeTitle = document.querySelector('.welcome-title');
        let greeting = 'Selamat Datang';
        
        if (hour < 12) greeting = 'Selamat Pagi';
        else if (hour < 17) greeting = 'Selamat Siang';
        else greeting = 'Selamat Malam';
        
        welcomeTitle.textContent = greeting + ', <?php echo $_SESSION['username']; ?> 👋';

        // Auto refresh for dynamic content (if needed)
        setInterval(() => {
            // Update any dynamic content here
            const now = new Date();
            console.log('Dashboard refreshed at:', now.toLocaleTimeString());
        }, 60000); // Every minute
    </script>
</body>
</html>