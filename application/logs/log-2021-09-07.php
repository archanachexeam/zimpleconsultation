<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-09-07 05:11:02 --> 404 Page Not Found: Frontoffice/login
ERROR - 2021-09-07 05:11:51 --> 404 Page Not Found: Frontoffice/login
ERROR - 2021-09-07 05:11:54 --> 404 Page Not Found: Frontoffice/login
ERROR - 2021-09-07 05:12:19 --> 404 Page Not Found: Frontffice/index
ERROR - 2021-09-07 05:19:06 --> 404 Page Not Found: Frontoffice/.http:
ERROR - 2021-09-07 05:19:31 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:30:42 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:30:46 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:30:56 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:31:00 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:31:09 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:31:15 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:31:26 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:31:34 --> 404 Page Not Found: transactions/Doctorleaves/index
ERROR - 2021-09-07 05:32:18 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:32:38 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:32:43 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:32:52 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:33:11 --> 404 Page Not Found: Doctor/.http:
ERROR - 2021-09-07 05:33:39 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:33:50 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:33:59 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:34:03 --> Query error: Column 'doctor' in where clause is ambiguous - Invalid query: SELECT `trn_bookings`.*, `mst_departments`.`departmentName`, `mst_doctors`.`doctorFName`, `mst_doctors`.`doctorLName`, `mst_doctors`.`doctorQualifications`, `mst_patients`.*, `mst_slots`.`slotName`, `sys_bookingstatus`.`bookingStatusName`
FROM `trn_bookings`
LEFT JOIN `mst_doctors` ON `trn_bookings`.`doctor` = `mst_doctors`.`doctorId`
LEFT JOIN `mst_departments` ON `mst_doctors`.`doctorDepartment` = `mst_departments`.`departmentId`
LEFT JOIN `mst_patients` ON `trn_bookings`.`patient` = `mst_patients`.`patientId`
LEFT JOIN `link_doctor_slots` ON `trn_bookings`.`bookingSlot` = `link_doctor_slots`.`doctorSlotId`
LEFT JOIN `mst_slots` ON `link_doctor_slots`.`slot` = `mst_slots`.`slotId`
LEFT JOIN `sys_bookingstatus` ON `trn_bookings`.`bookingStatus` = `sys_bookingstatus`.`bookingStatusId`
WHERE `patient` = '3'
AND `doctor` = '1'
AND `bookingId` != '5'
AND `consultationDate` < '2021-09-07'
AND `bookingStatus` = 5
ERROR - 2021-09-07 05:36:03 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:37:13 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:37:24 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:37:31 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:37:43 --> 404 Page Not Found: Doctor/.http:
ERROR - 2021-09-07 05:37:56 --> 404 Page Not Found: Patient/.http:
ERROR - 2021-09-07 05:38:39 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:38:59 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:50:31 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:50:37 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:50:37 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:51:26 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:51:30 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:51:31 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:51:31 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:02 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:03 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:03 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:15 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:16 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:16 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:29 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:30 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:31 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:34 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:35 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:35 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:40 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:41 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:41 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:47 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:48 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:48 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:51 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:52 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:52 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:56 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 05:52:57 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 05:52:57 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 06:09:20 --> Severity: Notice --> Undefined variable: notifications /home/l4oa5w48el4g/public_html/doctorbooking.hexeam.org/application/views/admin/templates/header.php 186
ERROR - 2021-09-07 06:09:21 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 06:09:22 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 06:09:29 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 06:09:40 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-09-07 06:09:40 --> 404 Page Not Found: Patient/.http:
ERROR - 2021-09-07 06:09:49 --> 404 Page Not Found: Faviconico/index
ERROR - 2021-09-07 06:09:56 --> 404 Page Not Found: Patient/.http:
ERROR - 2021-09-07 06:12:49 --> 404 Page Not Found: Assets/plugins
