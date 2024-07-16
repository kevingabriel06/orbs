


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jay'z Staycation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: auto;
            background-color: white;
            padding: 20px;
        }
        .header {
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .booking {
            text-align: center;
            margin: 20px 0;
        }
        .booking h2 {
            margin: 0;
            color: red;
        }
        .details, .contact {
            margin: 20px 0;
        }
        .details p, .contact p {
            margin: 5px 0;
        }
        .amenities, .inclusions {
            margin: 20px 0;
        }
        .amenities ul, .inclusions ul {
            list-style-type: none;
            padding: 0;
        }
        .amenities ul li, .inclusions ul li {
            background: #e9f5e9;
            margin: 5px 0;
            padding: 10px;
            border-left: 5px solid green;
        }
        .images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .images img {
            width: calc(33.333% - 10px);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Jay'z Hotel</h1>
        <h5>Welcome to Jay'z Hotel, a luxurious and modern loft-type accommodation located in the heart of Mandaluyong, right in front of Boni station. With its elegantly designed three-bedroom units, top-notch amenities including a stunning rooftop pool, and breathtaking panoramic city views, Jay'z Staycation offers the perfect blend of comfort, convenience, and style for families, couples, and groups seeking a memorable urban retreat.</h5>
    </div>

    <div class="booking">
        <h2>BOOK NOW!!!</h2>
    </div>

    <div class="details">
        <p>📍 JAY'Z Hotel <?php echo $user_id; ?></p>

        <p>3 bedrooms, Loft type</p>
        <p>(BONI, MANDALUYONG)</p>
        <p>In front of Boni station</p>

        <p>⏱️ 22HRS!!</p>
        <p>⏰ CHECK IN: 2PM</p>
        <p>⏰ CHECK OUT: 12NN</p>
        <p>1,799 2PAX(2 ROOMS ARE CLOSED)</p>
        <p>2,899 4 PAX</p>
        <p>3,499 6 PAX (plus 500 for additional pax)</p>
    </div>

    <div class="amenities">
        <h3>Amenities</h3>
        <ul>
            <li>✅ ROOFDECK POOL</li>
            <li>✅ INDOOR POOL (2nd FLR)</li>
            <li>✅ LOUNGE (ROOFTOP BAR)</li>
            <li>✅ CAFÉ</li>
        </ul>
    </div>

    <div class="inclusions">
        <h3>Inclusion</h3>
        <ul>
            <li>✅ GOOGLE TV</li>
            <li>✅ WIFI (100Mbps)</li>
            <li>✅ NETFLIX AND VIVA MAX</li>
            <li>✅ INDUCTION (200Php)</li>
            <li>✅ MICROWAVE</li>
            <li>✅ RICE COOKER</li>
            <li>✅ ELECTRIC KETTLE</li>
            <li>✅ RGB LIGHTS</li>
            <li>✅ KITCHEN UTENSILS</li>
            <li>✅ REF</li>
            <li>✅ 3 AIRCONDITIONED ROOMS</li>
        </ul>
    </div>

    <div class="contact">
        <h3>For Inquiries:</h3>
        <p>CONTACT US <?php echo $this->session->userdata('user_id') ?></>
        <p>JAY'Z Hotel FB PAGE</p>
        <p>09566465341</p>
        <p>0997128313</p>
        <p>09983937367</p>
        <p>Via SMS and VIBER 📞</p>
    </div>

    <div class="images">
        <img src="../images/1.jpg" alt="Image 1">
        <img src="../images/2.jpg" alt="Image 2">
        <img src="../images/3.jpg" alt="Image 3">
        <img src="../images/4.jpg" alt="Image 4">
        <img src="../images/5.jpg" alt="Image 5">
        <img src="../images/6.jpg" alt="Image 6">
        <img src="../images/7.jpg" alt="Image 7">
        <img src="../images/8.jpg" alt="Image 8">
        <img src="../images/9.jpg" alt="Image 9">
    </div>

</div>

</body>
</html>
