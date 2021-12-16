<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Siswa Baru</title>
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Roboto:wght@400;700;900&display=swap");
        html,
        body {
            height: 100%;
        }
        section {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: min(80vh, 600px);
            background-color: #FFFFFF;
            margin: 3rem;
            padding: 2rem;
            text-align: center;
            font-family: "Roboto", sans-serif;
        }
        section:before {
            position: fixed;
            content: "";
            top: 0;
            width: 100%;
            height: 100%;
            background: url("https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80");
            background-size: cover;
            background-position: center;
        }
        h1, h2 {
            margin-top: 2rem;
            color: white;
        }
        h1 {
            position: relative;
            font-weight: 900;
            font-size: clamp(2.5rem, 5vw, 4rem);
        }
        h1 div {
            color: rgb(255, 200, 200);
        }
        h2 {
            font-size: clamp(1.3rem, 2vw, 3rem);
        }
        .cta {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1.5rem;
        }
        .cta button {
            border: none;
            padding: 1rem 2rem;
            font-size: clamp(1.1rem, 1.3vw, 3rem);
            border-radius: 10px;
            cursor: pointer;
        }
        .cta button:first-of-type {
            background-color: white;
            color: rgb(121, 27, 27);
            transition: all 300ms ease-in;
        }
        .cta button:first-of-type:hover {
            background-color: rgb(184, 70, 70);
            color: white;
        }
        .cta button:nth-of-type(2) {
            background-color: rgb(184, 70, 70);
            color: white;
        }
        .cta button:nth-of-type(2):hover {
            background-color: white;
            color: rgb(184, 70, 70);
        }
        @media (min-width: 600px) {
            .cta {
                flex-direction: row;
            }
        }
    </style>
</head>

<body>
    <section>
    <h1>Pendaftaran
        <div>Siswa Baru</div>
    </h1>
    <div class="cta">
        <a href="form-daftar.php"><button>Daftar Baru</button></a>
        <a href="list-siswa.php"><button>Pendaftar</button></a>
    </div>

    <?php if(isset($_GET['status'])): ?>
    <p>
        <?php
            if($_GET['status'] == 'sukses'){
                echo "Pendaftaran siswa baru berhasil!";
            } else {
                echo "Pendaftaran gagal!";
            }
        ?>
    </p>
    <?php endif; ?>
    </section>

</body>
</html>