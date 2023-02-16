# laravel_manajemen_stok_v1

PHP 8.0.2
LARAVEL 8

- CARA MENJALANKAN PROGRAM
composer install
php artisan storage:link
php artisan key:generate
set .env
php artisan migrate
php artisan db:seed
php artisan serve

- AKTOR
PEGAWAI: 
username: Admin
pw: Admin
code: 1234

======================================================================================================================================================================

- MENERAPKAN ID GENERATOR UNTUK PRODUCT DAN PEGAWAI
MISAL: PR-001, PR-002 dst..

- MENERAPKAN CODE VERIFICATION
jadi ketika pegawai ingin mengubah dan menambah data tertentu, dia butuh kode verifikasi yang mana itu hanya diketahui oleh atasan.

- MENERAPKAN OLD VALUE APABILA GAGAL INPUT DATA
* dicontroller
return redirect()->back()->withInput($request->all());
* view
{{old('name')}}

======================================================================================================================================================================

-DASHBOARD

![Screenshot (1060)](https://user-images.githubusercontent.com/58543758/219368443-def3dbe4-8098-475d-a036-43589b5f7823.png)

-CETAK STRUK PELANGGAN

![Screenshot (1061)](https://user-images.githubusercontent.com/58543758/219368442-66e1935b-6695-4db5-929a-674c085c6fbe.png)

-STOK BARANG

![Screenshot (1062)](https://user-images.githubusercontent.com/58543758/219368502-303694b2-84df-4b35-aace-3f182ffde95c.png)

-CETAK LAPORAN

![Screenshot (1063)](https://user-images.githubusercontent.com/58543758/219368526-145cff87-554c-4642-99e5-313691f629b1.png)

