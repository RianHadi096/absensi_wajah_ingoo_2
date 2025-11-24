# TODO: Implement Attendance Data Management Per Month or Per Week

## 1. Controller Updates
- Enhance methods in app/Http/Controllers/AbsensiKaryawanController.php:
  - `historyAbsensiMaster()`, `historyAbsensiByKaryawan()`, and `historyAbsensi()`
  - Accept query parameters for filter type (week/month), and selected month or week
  - Filter attendance data by the specified date range
- Update AJAX endpoints `getAbsensiAjax()` and `getAbsensiAdminAjax()` to handle filtering parameters similarly

## 2. View Updates - Admin
- Modify `resources/views/admin/histori_absensi_karyawan.blade.php`:
  - Add UI controls for filter selection:
    - Dropdown or buttons for selecting filter type: "Per Minggu" or "Per Bulan"
    - Date or week pickers to select specific period
  - Update HTML and JavaScript to send filter parameters in AJAX requests and form submissions
  - Preserve filter parameters on pagination and sorting

## 3. View Updates - Employee
- Modify `resources/views/karyawan/histori_absensi.blade.php` similarly:
  - Add filter UI controls for weekly/monthly selection
  - Adapt pagination and AJAX sorting to include filters

## 4. Model (optional)
- Add scopes or helper functions in `app/Models/AbsensiKaryawan.php` to filter records by week or month based on dates

## 5. Testing
- Verify correct filtering by month and week for both admin and employee views
- Test AJAX sorting and pagination work with filters applied
- Ensure UI usability on desktop and mobile views

## 6. Documentation
- Update any README or user guides if applicable to explain new filter features

---

This plan will enable managing attendance data more flexibly as per user request.

Next: Proceed with step 1 by updating controller methods.
