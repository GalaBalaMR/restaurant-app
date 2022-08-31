<body style="color: #444444;
             text: center;">
    <h1 style=" padding: 1rem;
                background: #faa422;
                border-radius: 5px;">Dobrý deň</h1>
    <p>{{ $info->message }}</p>
    <p style="">Príspevok od, pán/pani {{ $info->name }}</p>
    <p>Email: {{ $info->email }}</p>
    
</body>