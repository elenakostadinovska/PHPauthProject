<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 30px;
            color: #343a40;
        }

        .cards-container {
            display: flex;
            gap: 30px;
        }

        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            width: 400px;
            height: 150px;
            text-align: center;
            padding: 20px;
            color: #fff;
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
            position: relative;
            color: #f8f9fa;
        }

        .card h2::after {
            content: "";
            display: block;
            width: 100%;
            height: 1px;
            background-color: white;
            margin: 8px auto 0;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }

        .card.students {
            background-color: #007bff;
        }

        .card.universities {
            background-color: #28a745;
        }

        .card.courses {
            background-color: #17a2b8;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <div class="cards-container">
        <div class="card students">
            <h2>Students</h2>
            <p>Total Students</p>
            <p>150</p>
        </div>
        <div class="card universities">
            <h2>Universities</h2>
            <p>Total Universities</p>
            <p>10</p>
        </div>
        <div class="card courses">
            <h2>Courses</h2>
            <p>Total Courses</p>
            <p>25</p>
        </div>
    </div>
</body>
</html>
