<?php

include("config.php");

// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
    header('Location: list-siswa.php');
}

//ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM calon_siswa WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Edit Siswa</title>
    <style type="text/css">
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }
        body {
            padding: 1em;
            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 15px;
            color: #444;
            background-color: rgb(182, 64, 64);
        }
        h1 {
            color: rgb(219, 89, 89);
        }
        h4 {
            color: #444;
        }
        input,
        input[type= "radio"] + label,
        input[type= "checkbox"] + label:before,
        select option,
        select {
            width: 100%;
            padding: 1em;
            line-height: 1.4;
            border: 1px solid #e5e5e5;
            border-radius: 3px;
            -webkit-transition: 0.35s ease-in-out;
            -moz-transition: 0.35s ease-in-out;
            -o-transition: 0.35s ease-in-out;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
        }
        input:focus {
            outline: 0;
            border-color: rgb(182, 64, 64);
        }
        input:focus + .input-icon i {
            color: rgb(182, 64, 64);
        }
        input:focus + .input-icon:after {
            border-right-color: rgb(219, 89, 89);
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"] + label,
        select {
            display: inline-block;
            width: 50%;
            text-align: center;
            float: left;
            border-radius: 0;
        }
        input[type="radio"] + label:first-of-type {
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
        }
        input[type="radio"] + label:last-of-type {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }
        input[type="radio"] + label i {
            padding-right: 0.4em;
        }
        input[type="radio"]:checked + label,
        input:checked + label:before,
        select:focus, select:active {
            background-color: rgb(219, 89, 89);
            color: #fff;
            border-color: rgb(219, 89, 89);
        }
        input[type="checkbox"] {
            display: none;
        }
        input[type="checkbox"] + label {
            position: relative;
            display: block;
            padding-left: 1.6em;
        }
        input[type="checkbox"] + label:before {
            position: absolute;
            top: 0.2em;
            left: 0;
            display: block;
            width: 1em;
            height: 1em;
            padding: 0;
            content: "";
        }
        input[type="checkbox"] + label:after {
            position: absolute;
            top: 0.45em;
            left: 0.2em;
            font-size: 0.8em;
            color: #fff;
            opacity: 0;
            font-family: FontAwesome;
            content: "\f00c";
        }
        input:checked + label:after {
            opacity: 1;
        }
        select {
            height: 3.4em;
            line-height: 2;
        }
        select:first-of-type {
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
        }
        select:last-of-type {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }
        select:focus, select:active {
            outline: 0;
        }
        select option {
            background-color: rgb(219, 89, 89);
            color: #fff;
        }
        .input-group {
            margin-bottom: 1em;
            zoom: 1;
        }
        .input-group:before, .input-group:after {
            content: "";
            display: table;
        }
        .input-group:after {
            clear: both;
        }
        .input-group-icon {
            position: relative;
        }
        .input-group-icon input {
            padding-left: 4.4em;
        }
        .input-group-icon .input-icon {
            position: absolute;
            top: -6px;
            left: -10px;
            height: 3.7em;
            text-align: center;
            pointer-events: none;
        }
        .input-group-icon .input-icon:after {
            position: absolute;
            top: 0.6em;
            bottom: 0.6em;
            left: 3.4em;
            display: block;
            border-right: 1px solid #e5e5e5;
            content: "";
            -webkit-transition: 0.35s ease-in-out;
            -moz-transition: 0.35s ease-in-out;
            -o-transition: 0.35s ease-in-out;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
        }
        .input-group-icon .input-icon i {
            -webkit-transition: 0.35s ease-in-out;
            -moz-transition: 0.35s ease-in-out;
            -o-transition: 0.35s ease-in-out;
            transition: 0.35s ease-in-out;
            transition: all 0.35s ease-in-out;
        }
        .container {
            max-width: 38em;
            padding: 1em 3em 2em 3em;
            margin: 0em auto;
            background-color: #fff;
            border-radius: 4.2px;
            box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
        }
        .row {
            zoom: 1;
        }
        .row:before, .row:after {
            content: "";
            display: table;
        }
        .row:after {
            clear: both;
        }
        .col-half {
            padding-right: 10px;
            float: left;
            width: 50%;
        }
        .col-half:last-of-type {
            padding-right: 0;
        }
        .col-third {
            padding-right: 10px;
            float: left;
            width: 33.33333333%;
        }
        .col-third:last-of-type {
            padding-right: 0;
        }
        @media only screen and (max-width: 540px) {
            .col-half {
                width: 100%;
                padding-right: 0;
            }
        }
        .button-42 {
            background-color: rgb(219, 89, 89);
            border-radius: 6px;
            box-shadow: rgba(0, 0, 0, 0.1) 0 2px 4px;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: Inter,-apple-system,system-ui,Roboto,"Helvetica Neue",Arial,sans-serif;
            height: 35px;
            line-height: 35px;
            outline: 0;
            overflow: hidden;
            padding: 0 20px;
            pointer-events: auto;
            position: relative;
            text-align: center;
            touch-action: manipulation;
            user-select: none;
            -webkit-user-select: none;
            vertical-align: top;
            white-space: nowrap;
            width: 20%;
            z-index: 9;
            border: 0;
            transition: box-shadow .2s;
        }
        .button-42:hover {
            box-shadow: rgba(253, 76, 0, 0.5) 0 3px 8px;
        }
    </style>
</head>

<body>
    <div class="container">
    <form action="proses-edit.php" method="POST">

        <div class="row">
            <h1>Formulir Edit Siswa</h1>
                <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />
            <h4>Nama Lengkap</h4>
            <div class="input-group input-group-icon">
                <input for="nama" type="text" name="nama" placeholder="Full Name" value="<?php echo $siswa['nama'] ?>"/>
                <div class="input-icon"></div>
            </div>
            <h4>Alamat</h4>
            <div class="input-group input-group-icon">
                <input for="alamat" name="alamat" type="text" placeholder="Address" value="<?php echo $siswa['alamat'] ?>"/>
                <div class="input-icon"></div>
            </div>
            </div>
            <div class="row">
            <div class="col-half">
                <h4>Jenis Kelamin</h4>
                <div class="input-group">
                <?php $jk = $siswa['jenis_kelamin']; ?>
                <input id="gender_male" type="radio" name="jenis_kelamin" value="laki-laki" <?php echo ($jk == 'laki-laki') ? "checked": "" ?>/>
                <label for="gender_male">Male</label>
                <input id="gender_female" type="radio" name="jenis_kelamin" value="perempuan" <?php echo ($jk == 'perempuan') ? "checked": "" ?>/>
                <label for="gender_female">Female</label>
                </div>
            </div>
            </div>
            <div class="row">
            <h4>Agama</h4>
            <div class="input-group">
            <?php $agama = $siswa['agama']; ?>
            <select for="agama" name="agama">
                <option <?php echo ($agama == 'Islam') ? "selected": "" ?>>Islam</option>
                <option <?php echo ($agama == 'Kristen') ? "selected": "" ?>>Kristen</option>
                <option <?php echo ($agama == 'Hindu') ? "selected": "" ?>>Hindu</option>
                <option <?php echo ($agama == 'Budha') ? "selected": "" ?>>Buddha</option>
                <option <?php echo ($agama == 'Atheis') ? "selected": "" ?>>Atheis</option>
            </select>
            </div>
            <h4><br>Sekolah Asal</h4>
            <div class="input-group input-group-icon">
            <input type="text" for="sekolah_asal" name="sekolah_asal" placeholder="School" value="<?php echo $siswa['sekolah_asal'] ?>"/>
                <div class="input-icon"></div>
            </div>
            <!-- <div class="col-half">
                <div class="input-group input-group-icon">
                <input type="text" placeholder="Card CVC"/>
                <div class="input-icon"><i class="fa fa-user"></i></div>
                </div>
            </div>
            <div class="col-half">
                <div class="input-group">
                <select>
                    <option>01 Jan</option>
                    <option>02 Jan</option>
                </select>
                <select>
                    <option>2015</option>
                    <option>2016</option>
                </select>
                </div>
            </div> -->
            </div>
            <div class="row"></br>
                <button type="submit" value="Simpan" name="simpan" class="button-42">Simpan</button>
                <a href="list-siswa.php"><button type="button" class="button-42">Batal</button></a>
        </div>

        <!-- <fieldset>

            <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />

        <p>
            <label for="nama">Nama: </label>
            <input type="text" name="nama" placeholder="nama lengkap" value="<?php echo $siswa['nama'] ?>" />
        </p>
        <p>
            <label for="alamat">Alamat: </label>
            <textarea name="alamat"><?php echo $siswa['alamat'] ?></textarea>
        </p>
        <p>
            <label for="jenis_kelamin">Jenis Kelamin: </label>
            <?php $jk = $siswa['jenis_kelamin']; ?>
            <label><input type="radio" name="jenis_kelamin" value="laki-laki" <?php echo ($jk == 'Laki-Laki') ? "checked": "" ?>> Laki-laki</label>
            <label><input type="radio" name="jenis_kelamin" value="perempuan" <?php echo ($jk == 'Perempuan') ? "checked": "" ?>> Perempuan</label>
        </p>
        <p>
            <label for="agama">Agama: </label>
            <?php $agama = $siswa['agama']; ?>
            <select name="agama">
                <option <?php echo ($agama == 'Islam') ? "selected": "" ?>>Islam</option>
                <option <?php echo ($agama == 'Kristen') ? "selected": "" ?>>Kristen</option>
                <option <?php echo ($agama == 'Hindu') ? "selected": "" ?>>Hindu</option>
                <option <?php echo ($agama == 'Budha') ? "selected": "" ?>>Budha</option>
                <option <?php echo ($agama == 'Atheis') ? "selected": "" ?>>Atheis</option>
            </select>
        </p>
        <p>
            <label for="sekolah_asal">Sekolah Asal: </label>
            <input type="text" name="sekolah_asal" placeholder="nama sekolah" value="<?php echo $siswa['sekolah_asal'] ?>" />
        </p>
        <p>
            <input type="submit" value="Simpan" name="simpan" />
        </p>

        </fieldset> -->


    </form>
    </div>

    </body>
</html>