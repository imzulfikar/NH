<?php

class kartuLaundry extends Route{

   public function __construct()
   {
   $this -> st = new state;
   }

    public function index()
    {
      $this -> cekUserLogin('userSes');
      $this -> st -> query("SELECT * FROM tbl_kartu_laundry ORDER BY id DESC;");
      $data['kartuLaundry'] = $this -> st -> queryAll();
      $this -> bind('dasbor/kartuLaundry/kartuLaundry', $data);
    }

    public function formRegistrasiCucian()
    {
       $bHuruf = "QWERTYUIOPLKJHGFDSAZXCVBNM";
       $bAngka = "1234567890";
       $acakHuruf_1 = str_shuffle($bHuruf);
       $acakHuruf_2 = str_shuffle($bHuruf);
       $acakAngka = str_shuffle($bAngka);
       $data['kodeRegistrasi'] = substr($acakHuruf_1, 0, 2).substr($acakAngka, 0, 6).substr($acakHuruf_2, 0, 4);
       $data['waktuMasuk'] = date("Y-m-d H:i");
      $this -> bind('dasbor/kartuLaundry/formRegistrasiCucian', $data);
    }

    public function prosesRegistrasiCucian()
    {
      $kode = $this -> inp('kodeRegistrasi');
      $waktuMasuk = date("Y-m-d H:i:s");
      $pelanggan = $this -> inp('pelanggan');
      $query = "INSERT INTO tbl_kartu_laundry VALUES (null, :kode_service, :pelanggan, :waktu_mulai, '0000-00-00 00:00:00','0000-00-00 00:00:00','pending','admin', 'hold');";
      $this -> st -> query($query);
      $this -> st -> querySet('kode_service', $kode);
      $this -> st -> querySet('pelanggan', $pelanggan);
      $this -> st -> querySet('waktu_mulai', $waktuMasuk);
      $this -> st -> queryRun();
      
      $bHuruf = "QWERTYUIOPLKJHGFDSAZXCVBNM";
      $bAngka = "1234567890";
      $acakHuruf_1 = str_shuffle($bHuruf);
      $acakHuruf_2 = str_shuffle($bHuruf);
      $acakAngka = str_shuffle($bAngka);
      $kodeRoom = substr($acakHuruf_1, 0, 2).substr($acakAngka, 0, 6).substr($acakHuruf_2, 0, 4);
      $queryToRoom = "INSERT INTO tbl_laundry_room VALUES(null, '$kodeRoom', '$kode', '0', 'admin', 'ready');";
      $this -> st -> query($queryToRoom);
      $this -> st -> queryRun();
      
      $data['status'] = 'sukses';
      $this -> toJson($data);
    }

}
