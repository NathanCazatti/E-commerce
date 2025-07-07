<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do E-Commerce</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #e0e0e0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .dashboard-container {
            margin: auto;
            width: min(90%, 1200px);
            background: #f5f5f5;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #606c88 0%, #3f4c6b 100%);
            color: white;
            border-radius: 12px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 200px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card:nth-child(2) {
            background: linear-gradient(135deg, #485563 0%, #29323c 100%);
        }

        .stat-card .title {
            font-size: 18px;
            font-weight: 500;
            opacity: 0.9;
        }

        .stat-card .value {
            font-size: 48px;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card .description {
            font-size: 14px;
            opacity: 0.8;
        }

        .stat-card .icon {
            font-size: 24px;
            margin-bottom: 15px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        header {
            grid-column: 1/-1;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-top: 8px;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 20px;
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Painel de E-Commerce</h1>
            <p class="subtitle">Visão geral do desempenho da sua loja online</p>
        </header>

        <div class="stat-card">
            <div>
                <div class="icon">&bull;</div>
                <div class="title">Total de Produtos</div>
                <div class="value" id="productCount">10</div>
                <div class="description">Disponíveis em sua loja</div>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <div class="icon">👥</div>
                <div class="title">Clientes Ativos</div>
                <div class="value" id="clientCount">187</div>
                <div class="description">Clientes registrados</div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('clientCount').textContent = 
            Math.floor(Math.random() * 900) + 100;
    </script>
</body>
</html>

