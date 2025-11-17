# TODO: Add Clock In/Out with Photos to Attendance System

## Tasks
- [x] Create migration to add jam_masuk, jam_keluar, foto_masuk, foto_keluar columns to absensi_karyawan table
- [x] Update AbsensiKaryawan model to include new fillable fields
- [x] Modify AbsensiKaryawanController to handle clock in/out logic with photo storage
- [x] Update histori_absensi.blade.php to display jam_masuk, jam_keluar, and photo links
- [x] Add clock out button in histori_absensi.blade.php with modal for photo capture
- [x] Add clockOut method in AbsensiKaryawanController
- [x] Add route for clock out
- [x] Add buttons for recording "Sakit" or "Izin" attendance outside working hours
- [x] Add methods in controller to handle "Sakit" and "Izin" recording
- [x] Add routes for "Sakit" and "Izin" recording
- [ ] Test the new clock in/out functionality and "Sakit"/"Izin" recording
