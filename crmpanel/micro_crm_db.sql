-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2025 at 04:20 AM
-- Server version: 10.6.20-MariaDB-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `micro_crm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mi_billing`
--

CREATE TABLE `mi_billing` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `inv_no` bigint(20) NOT NULL,
  `inv_date` date NOT NULL,
  `admno` varchar(50) NOT NULL,
  `gtotal` varchar(20) NOT NULL,
  `ggsttotal` varchar(20) NOT NULL,
  `gsubtotal` varchar(20) NOT NULL,
  `fright` varchar(20) NOT NULL,
  `adjustment` varchar(20) NOT NULL,
  `nettotal` varchar(20) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `pdetail` mediumtext NOT NULL,
  `remark` mediumtext NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_billing_detail`
--

CREATE TABLE `mi_billing_detail` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `inv_id` varchar(20) NOT NULL,
  `inv_no` varchar(50) NOT NULL,
  `cat_id` varchar(20) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `rate` varchar(20) NOT NULL,
  `drate` varchar(20) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `unit_id` varchar(10) NOT NULL,
  `total` varchar(25) NOT NULL,
  `gst` varchar(25) NOT NULL,
  `gsttotal` varchar(25) NOT NULL,
  `subtotal` varchar(25) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_branch`
--

CREATE TABLE `mi_branch` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `region_id` varchar(50) NOT NULL,
  `branch_name` varchar(80) NOT NULL,
  `head_name` varchar(50) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_branch`
--

INSERT INTO `mi_branch` (`id`, `rdate`, `cmp_id`, `user_id`, `region_id`, `branch_name`, `head_name`, `address`, `phone`, `fax`, `email`, `description`, `mi_status`) VALUES
(1, '2022-09-10 11:29:43', 'aadya', '1', '2', 'Nai sadak', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes'),
(2, '2022-09-10 11:33:12', 'aadya', '1', '2', 'Karkardooma', '', 'Delhi', '9898816547', '', 'krisoft03@gmail.com', '', 'Yes'),
(3, '2022-10-06 17:47:32', 'microcrm', '7', '8', 'All', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes'),
(4, '2024-08-15 20:00:04', 'microcrm', '7', '9', 'Delhi NCR', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_category`
--

CREATE TABLE `mi_category` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_category`
--

INSERT INTO `mi_category` (`id`, `rdate`, `cmp_id`, `user_id`, `cat_name`, `description`, `mi_status`) VALUES
(2, '2022-09-26 14:09:05', 'aadya', '1', 'Electronics', '', 'Yes'),
(3, '2022-10-06 18:07:08', 'microcrm', '7', 'Software', '', 'Yes'),
(4, '2023-01-30 10:53:18', 'microcrm', '7', 'Web', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_cmp_profile`
--

CREATE TABLE `mi_cmp_profile` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `regno` varchar(100) NOT NULL,
  `affiliation` varchar(100) NOT NULL,
  `cmp_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `emails` varchar(200) NOT NULL,
  `web_url` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `logo` varchar(100) NOT NULL,
  `level1` varchar(50) NOT NULL,
  `level2` varchar(50) NOT NULL,
  `shift` varchar(5) NOT NULL DEFAULT 'No',
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_cmp_profile`
--

INSERT INTO `mi_cmp_profile` (`id`, `rdate`, `cmp_id`, `user_id`, `emp_id`, `regno`, `affiliation`, `cmp_name`, `address`, `mobile`, `emails`, `web_url`, `description`, `logo`, `level1`, `level2`, `shift`, `mi_status`) VALUES
(1, '2022-09-02 18:50:23', 'aadya', '1', '', '12345', 'AFF12345', 'Aadya Power Projects', 'Dadri', '1204547951', 'aadya@gmail.com', 'https://www.microelectra.in/crmsoft/aadya', 'yes', 'aadya_1.jpeg', 'Class', 'Section', 'No', 'Yes'),
(4, '2022-10-06 16:57:14', 'microcrm', 'microelectra', 'microcrm', '09ANNPB8956A1ZV', '09ANNPB8956A1ZV', 'Microelectra IT Corporation', 'Tilapta karanwas', '8130576962', 'rexsoft01@gmail.com', 'https://www.microelectra.in/crmpanel/crmsoft/microcrm', '', 'microcrm.jpg', '', '', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_company`
--

CREATE TABLE `mi_company` (
  `id` int(11) NOT NULL,
  `rdate` date NOT NULL,
  `reseller_id` varchar(100) NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `cmp_pwd` varchar(50) NOT NULL,
  `cmp_url` varchar(100) NOT NULL,
  `cmp_name` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `other_contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `other_email` varchar(50) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `gst_no` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `exp_date` date NOT NULL,
  `renew_amt` varchar(15) NOT NULL,
  `image` varchar(50) NOT NULL,
  `act_status` varchar(5) NOT NULL DEFAULT 'Yes',
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_company`
--

INSERT INTO `mi_company` (`id`, `rdate`, `reseller_id`, `cmp_id`, `cmp_pwd`, `cmp_url`, `cmp_name`, `mobile`, `other_contact`, `email`, `other_email`, `regno`, `gst_no`, `address`, `amount`, `exp_date`, `renew_amt`, `image`, `act_status`, `mi_status`) VALUES
(1, '2022-02-15', 'microelectra', 'aadya', '12345', 'https://www.microelectra.in/crmsoft/aadya', 'Aadya Power', '1204547951', '', 'aadya@gmail.com', '', '12345', 'AFF12345', 'Dadri', '12000', '2024-02-15', '5000', 'microdemo.png', 'Yes', 'Yes'),
(4, '2022-10-06', 'microelectra', 'microcrm', 'Password@1612', 'https://www.microelectra.in/crmpanel/crmsoft/microcrm', 'Microelectra IT Corporation', '8130576962', '9899816353', 'rexsoft01@gmail.com', '', '09ANNPB8956A1ZV', '09ANNPB8956A1ZV', 'Tilapta karanwas', '12000', '2025-11-30', '5000', 'microcrm.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_complaint_nature`
--

CREATE TABLE `mi_complaint_nature` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `complaint_nature` varchar(100) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_complaint_nature`
--

INSERT INTO `mi_complaint_nature` (`id`, `rdate`, `cmp_id`, `user_id`, `complaint_nature`, `mi_status`) VALUES
(1, '2022-09-16 20:13:14', 'aadya', 'aadya', 'Adapter Faulty', 'Yes'),
(2, '2022-09-16 20:13:31', 'aadya', '1', 'BATTERY NOT CHARGING', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_country`
--

CREATE TABLE `mi_country` (
  `id` int(11) NOT NULL,
  `rdate` datetime DEFAULT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_country`
--

INSERT INTO `mi_country` (`id`, `rdate`, `cmp_id`, `user_id`, `country`, `mi_status`) VALUES
(2, '2022-09-15 20:36:25', 'aadya', '1', 'India', 'Yes'),
(3, '2022-09-16 19:46:32', 'aadya', '1', 'Shri Lanka', 'Yes'),
(4, '2022-10-06 17:56:20', 'microcrm', '7', 'India', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_department`
--

CREATE TABLE `mi_department` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_department`
--

INSERT INTO `mi_department` (`id`, `rdate`, `cmp_id`, `user_id`, `department_name`, `description`, `mi_status`) VALUES
(1, '2022-10-10 14:55:32', 'microcrm', '7', 'Director', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_designation`
--

CREATE TABLE `mi_designation` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `desig_level` varbinary(20) NOT NULL,
  `authority` varchar(15) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_designation`
--

INSERT INTO `mi_designation` (`id`, `rdate`, `cmp_id`, `user_id`, `designation`, `desig_level`, `authority`, `mi_status`) VALUES
(1, '2022-09-10 13:57:06', 'aadya', '1', 'director', 0x42656c6f77, '0', 'Yes'),
(2, '2022-09-11 17:46:24', 'aadya', '1', 'Manager', 0x42656c6f77, '1', 'Yes'),
(3, '2024-07-22 15:05:38', 'microcrm', '7', 'Sales Executive', 0x53616d65, '0', 'Yes'),
(4, '2024-07-22 15:11:47', 'microcrm', '7', 'Zonal Sales Manager', 0x41626f7665, '3', 'Yes'),
(5, '2024-08-15 20:07:10', 'microcrm', '7', 'Director', 0x41626f7665, '4', 'Yes'),
(6, '2024-08-15 20:07:23', 'microcrm', '7', 'Managing Director', 0x41626f7665, '4', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_desig_authority`
--

CREATE TABLE `mi_desig_authority` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `desig_id` varchar(10) NOT NULL,
  `module_id` mediumtext DEFAULT NULL,
  `feature_id` mediumtext DEFAULT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_desig_authority`
--

INSERT INTO `mi_desig_authority` (`id`, `rdate`, `cmp_id`, `user_id`, `desig_id`, `module_id`, `feature_id`, `mi_status`) VALUES
(1, '2022-09-11 17:43:11', 'aadya', '1', '1', 'setting,inventory,hr_payroll,work', 'branch,department,designation,billing,stkitem,party,unit,category,job,po', 'Yes'),
(2, '2022-09-11 18:06:58', 'aadya', '1', '2', 'inventory,hr_payroll,work', 'billing,stkitem,party,unit,category,job,po', 'Yes'),
(3, '2024-10-09 22:01:39', 'microcrm', '7', '3', '', 'billing,stkitem,party,unit', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_emp_juniors`
--

CREATE TABLE `mi_emp_juniors` (
  `id` int(11) NOT NULL,
  `rdate` datetime DEFAULT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `juniors` mediumtext NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_emp_juniors`
--

INSERT INTO `mi_emp_juniors` (`id`, `rdate`, `cmp_id`, `user_id`, `emp_id`, `juniors`, `mi_status`) VALUES
(1, '2022-09-14 12:01:20', 'aadya', '1', '6', '5', 'Yes'),
(2, '2022-10-07 15:03:40', 'microcrm', '7', '7', '8,9,11', 'Yes'),
(3, '2023-10-09 11:41:36', 'microcrm', '7', '10', '8,9,11', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_enquiry_status`
--

CREATE TABLE `mi_enquiry_status` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `enquiry_status` varchar(100) NOT NULL,
  `enquiry_level` varchar(10) DEFAULT NULL,
  `probability` varchar(10) DEFAULT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_enquiry_status`
--

INSERT INTO `mi_enquiry_status` (`id`, `rdate`, `cmp_id`, `user_id`, `enquiry_status`, `enquiry_level`, `probability`, `mi_status`) VALUES
(1, '2022-09-16 15:58:13', 'aadya', 'aadya', 'abcd', '1', '10', 'Yes'),
(8, '2022-10-06 22:49:55', 'microcrm', '7', 'ACTIVE ENQUIRY', '', '', 'Yes'),
(10, '2022-10-06 22:51:03', 'microcrm', '7', 'NEGOTIATION', '', '', 'Yes'),
(12, '2022-10-27 12:59:57', 'microcrm', '7', 'DISCUSSION', '', '', 'Yes'),
(13, '2023-10-18 16:52:36', 'microcrm', '7', 'CLOSED', '', '', 'Yes'),
(14, '2023-10-25 12:32:35', 'microcrm', '7', 'ORDER GENERATED', '', '', 'Yes'),
(15, '2024-08-15 20:44:40', 'microcrm', '7', 'QUOTATION', '1', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_expense_head`
--

CREATE TABLE `mi_expense_head` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `expense_head` varchar(100) NOT NULL,
  `exp_type` varchar(50) DEFAULT NULL,
  `exp_nature` varchar(50) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_expense_head`
--

INSERT INTO `mi_expense_head` (`id`, `rdate`, `cmp_id`, `user_id`, `expense_head`, `exp_type`, `exp_nature`, `rate`, `unit`, `mi_status`) VALUES
(1, '2022-09-16 20:55:44', 'aadya', '1', 'Bus', 'Travel', 'Unit Basis', '100', 'One time', 'Yes'),
(3, '2022-10-06 22:40:57', 'microcrm', '7', 'Rail', 'Travel', 'Unit Basis', '10', 'Per', 'Yes'),
(4, '2022-10-06 22:41:12', 'microcrm', '7', 'Bus', 'Travel', 'Unit Basis', '50', '', 'Yes'),
(5, '2022-10-06 22:41:26', 'microcrm', '7', 'Metro', 'Travel', '', '', '', 'Yes'),
(6, '2022-10-06 22:42:30', 'microcrm', '7', 'Parking', 'Travel', '', '', '', 'Yes'),
(7, '2022-10-06 22:42:39', 'microcrm', '7', 'Taxi', 'Travel', '', '', '', 'Yes'),
(8, '2022-10-06 22:42:47', 'microcrm', '7', 'Bike', 'Travel', '', '', '', 'Yes'),
(9, '2022-10-06 22:42:57', 'microcrm', '7', 'Car', 'Travel', '', '', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_feature`
--

CREATE TABLE `mi_feature` (
  `id` int(11) NOT NULL,
  `m_code` varchar(150) NOT NULL,
  `f_code` varchar(60) NOT NULL,
  `f_name` varchar(60) NOT NULL,
  `f_page_name` varchar(100) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_feature`
--

INSERT INTO `mi_feature` (`id`, `m_code`, `f_code`, `f_name`, `f_page_name`, `mi_status`) VALUES
(1, 'setting', 'branch', 'Branch', 'branch.php', 'Yes'),
(2, 'setting', 'department', 'Department', 'department.php', 'Yes'),
(3, 'setting', 'designation', 'Designation', 'designation.php', 'Yes'),
(4, 'inventory', 'billing', 'BIlling', 'billing.php', 'Yes'),
(5, 'inventory', 'stkitem', 'stock Item', 'item.php', 'Yes'),
(6, 'inventory', 'party', 'Party', 'party.php', 'Yes'),
(7, 'inventory', 'unit', 'Unit', 'unit.php', 'Yes'),
(8, 'inventory', 'category', 'Category', 'category', 'Yes'),
(9, 'work', 'job', 'Job', 'job.php', 'No'),
(10, 'sales', 'pending_lead', 'Pending Lead', 'allpendinglead.php', 'Yes'),
(11, 'sales', 'lead', 'Lead', 'lead.php', 'Yes'),
(12, 'report', 'new-lead-report', 'New Lead Report', 'new_lead_report.php', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_followup_type`
--

CREATE TABLE `mi_followup_type` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `followup_type` varchar(100) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_followup_type`
--

INSERT INTO `mi_followup_type` (`id`, `rdate`, `cmp_id`, `user_id`, `followup_type`, `mi_status`) VALUES
(1, '2022-09-16 14:52:01', 'aadya', 'aadya', 'Email', 'Yes'),
(3, '2022-10-06 22:44:54', 'microcrm', '7', 'Visit', 'Yes'),
(4, '2022-10-06 22:44:54', 'microcrm', '7', 'SMS', 'Yes'),
(5, '2022-10-06 22:44:54', 'microcrm', '7', 'E-mail', 'Yes'),
(6, '2022-10-06 22:44:54', 'microcrm', '7', 'Quotation', 'Yes'),
(7, '2022-10-06 22:44:54', 'microcrm', '7', 'Call', 'Yes'),
(8, '2022-10-06 22:44:54', 'microcrm', '7', 'Other', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_industry`
--

CREATE TABLE `mi_industry` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `industry` varchar(80) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_industry`
--

INSERT INTO `mi_industry` (`id`, `rdate`, `cmp_id`, `user_id`, `industry`, `mi_status`) VALUES
(1, '2022-09-14 20:23:27', 'aadya', '1', 'BASIC MATERIALS', 'Yes'),
(2, '2022-09-14 20:24:08', 'aadya', '1', 'ADVERTISING', 'Yes'),
(3, '2022-09-14 20:39:13', 'aadya', 'aadya', 'ADHESIVE COMPANY', 'Yes'),
(8, '2023-10-09 13:42:58', 'microcrm', '7', 'Common', 'Yes'),
(9, '2024-08-15 20:42:52', 'microcrm', '7', 'IT', 'Yes'),
(10, '2024-08-15 20:43:13', 'microcrm', '7', 'Manufacturing', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_item`
--

CREATE TABLE `mi_item` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `cat_id` varchar(50) NOT NULL,
  `i_code` varchar(50) DEFAULT NULL,
  `item_name` varchar(100) NOT NULL,
  `hsncode` varchar(50) DEFAULT NULL,
  `prate` varchar(10) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `unit_id` varchar(10) NOT NULL,
  `op_qty` varchar(10) NOT NULL DEFAULT '0',
  `gst` varchar(10) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_item`
--

INSERT INTO `mi_item` (`id`, `rdate`, `cmp_id`, `user_id`, `cat_id`, `i_code`, `item_name`, `hsncode`, `prate`, `rate`, `unit_id`, `op_qty`, `gst`, `description`, `image`, `mi_status`) VALUES
(1, '2022-09-26 16:40:52', 'aadya', '1', '2', 'P001', '100KVA (SUPERNOVA VECV SERIES)', '8654', '1200', '1500', '2', '', '18', 'ok', 'aadya_1.jpg', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_job`
--

CREATE TABLE `mi_job` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `job_no` varchar(50) NOT NULL,
  `job_date` date DEFAULT NULL,
  `gtotal` varchar(20) NOT NULL,
  `gsubtotal` varchar(20) NOT NULL,
  `nettotal` varchar(20) NOT NULL,
  `remark` mediumtext NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_job_detail`
--

CREATE TABLE `mi_job_detail` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `job_id` varchar(50) NOT NULL,
  `job_no` varchar(50) NOT NULL,
  `cat_id` varchar(20) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `rate` varchar(20) NOT NULL,
  `drate` varchar(20) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `unit_id` varchar(10) NOT NULL,
  `total` varchar(25) NOT NULL,
  `subtotal` varchar(25) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_lead`
--

CREATE TABLE `mi_lead` (
  `id` int(11) NOT NULL,
  `rdate` datetime DEFAULT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `enq_date` date DEFAULT NULL,
  `cmp_name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `web_url` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `industry` varchar(50) DEFAULT NULL,
  `segment` varchar(50) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `tcode` varchar(50) DEFAULT NULL,
  `ext_date` date DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `executive` varchar(50) DEFAULT NULL,
  `initiated_by` varchar(50) DEFAULT NULL,
  `enquiry_status` varchar(50) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_lead`
--

INSERT INTO `mi_lead` (`id`, `rdate`, `cmp_id`, `user_id`, `enq_date`, `cmp_name`, `address`, `web_url`, `email`, `mobile`, `telephone`, `product`, `industry`, `segment`, `source`, `reference`, `tcode`, `ext_date`, `country`, `state`, `location`, `pincode`, `executive`, `initiated_by`, `enquiry_status`, `remark`, `mi_status`) VALUES
(1, '2022-09-27 20:16:40', 'aadya', '1', '2022-09-27', 'Microelectra IT Solutions Pvt Ltd', 'Dadri', 'https://www.microelectra.in', 'info@microelectra.in', '9899816353', '0120-223223', '1', '1', '7', '2', '2', 'T001', '2022-09-27', '2', '1', '2', '203207', '5', '6', '1', 'ok', 'Yes'),
(2, '2022-10-27 12:52:30', 'microcrm', '7', '2022-10-27', 'Subtek Electronic', '271, Udyog Kendra-II, Ecotech-III, Gautam Budh Nagar,, Greater Noida, Uttar Pradesh 201306', 'https://www.subtech.in/', 'sub@gmail.com', '7812345678', '8355654566', '2', '5', '10', '4', '3', '001', '2022-10-27', '4', '7', '8', '', '8', '8', '2', '', 'Yes'),
(3, '2022-10-27 13:16:46', 'microcrm', '7', '2022-10-27', 'Suvana Energy Systems Pvt Ltd', 'PLOT NO 464 B, FLAT NO 103 (1ST FLOOR, near OUR LADY FATIMA FORANE CHURCH, Jasola, New Delhi, Delhi 110025', 'https://www.suvana.co.in/', 'shadab@esplindia.com', '9599955482', '9599955482', '2', '5', '9', '4', '3', '', '2022-10-27', '4', '18', '11', '', '8', '8', '12', '', 'Yes'),
(4, '2022-10-07 12:23:55', 'microcrm', '7', '2022-10-07', 'MEDICHEM ELECTRONICS PVT. LTD.', 'Electronic City, B-60, Sector 64, Noida, Uttar Pradesh 201301', 'https://medichemelectronic.com/', 'medichemelectronics@gmail.com', '9811139456', '9811139456', '2', '6', '16', '4', '3', '', '2022-10-07', '4', '7', '7', '', '8', '8', '8', '', 'Yes'),
(6, '2022-10-27 13:00:34', 'microcrm', '7', '2022-10-27', 'M/S Rashmi Electricals (Relec)', 'A1/205-206, Sector-17, Kavinagar Industrial Area, Swadeshi Compound, Ghaziabad, U.P. 201010', 'https://www.relec.in/', 'rashmielectricals@rediffmail.com', '9871014028', '9871014028', '2', '5', '10', '6', '5', '', '2022-10-27', '4', '7', '6', '', '8', '8', '12', 'Call not pick by client', 'Yes'),
(7, '2022-10-10 14:28:47', 'microcrm', '7', '2022-10-10', 'PENCLOTEK PANELS PRIVATE LIMITED', 'G-236, M.G Road , Phase 2, UPSIDC Industrial Area, Hapur, U.P, 201302, India', 'https://penclotek.com/', 'PRAMOD@PRAMODENGINEERING.IN', '9810345148', '9810345148', '2', '5', '10', '6', '5', '', '2022-10-10', '4', '7', '22', '', '8', '8', '7', 'Already using Zoho', 'Yes'),
(8, '2022-10-10 14:49:55', 'microcrm', '7', '2022-10-10', 'INDUCTO TECH AUTOMATION PVT. LTD.', 'Khasra no. 1003, Chhapraula, Bisrakh Rd, near Railway Phatak, Industrial Area, Greater Noida, Uttar Pradesh 201009', 'http://inductotech.com/', 'info@inductotech.com', '9990164100', '9990164100', '2', '5', '9', '6', '5', '', '2022-10-10', '4', '7', '6', '', '8', '8', '8', 'Call not pick', 'Yes'),
(9, '2022-10-10 14:54:26', 'microcrm', '7', '2022-10-10', 'ECS Engineering Pvt. Ltd.', '7/47, Site-2, UPSIDC Industrial Area, Mohan Nagar, Ghaziabad, (U.P.), India-201007', 'https://www.ecscontrolpanel.com/', 'sales@ecscontrolpanel.com', '9810217990', '9810217990', '2', '5', '10', '6', '5', '', '2022-10-10', '4', '7', '6', '', '8', '8', '8', 'Not required', 'Yes'),
(10, '2022-10-14 14:33:42', 'microcrm', '7', '2022-10-14', 'Engimedi Products And Services Pvt Ltd', 'Plot No. 46, Mahila Udhayami Park 1, Ecotech III, Greater Noida, Gautam Budh Nagar-201306, Uttar Pradesh, India', 'https://www.indiamart.com/engimediproductsservices', 'rnamanchaudhary@gmail.com', '', '', '2', '5', '10', '4', '3', '', '2022-10-14', '4', '7', '8', '', '8', '8', '8', '', 'Yes'),
(11, '2022-10-14 14:36:40', 'microcrm', '7', '2022-10-14', 'Shriji Power & Automation Private Limited', 'E-22, Surajpur Site C Industrial Block E Rd, Surajpur Industrial Area, Block E, UPSIDC Site C, Surajpur, Greater Noida, Uttar Pradesh 201306', 'https://www.indiamart.com/shrijipowerautomation', 'arunkagarwalandassociates@gmail.com', '9250924496', '9250924496', '2', '5', '10', '6', '5', '', '2022-10-14', '4', '7', '8', '', '8', '8', '8', '', 'Yes'),
(12, '2022-10-14 14:39:30', 'microcrm', '7', '2022-10-14', 'Synergy Electricals', 'J-47, Site-c Surajpur, Industrial Area, Upsidc, Greater Noida - 201308, Gautam Budh Nagar, Uttar Pradesh, India', 'https://www.synergyelectricals.co.in/', '', '', '', '', '', '', '', '', '', '2022-10-14', '4', '7', '8', '', '8', '8', '2', '', 'Yes'),
(13, '2022-10-15 11:56:13', 'microcrm', '7', '2022-10-15', 'INFORMAL INTERIORS PVT LTD', 'C 203, Industrial Area Phase I, Block C, Naraina Industrial Area Phase 1, Naraina, New Delhi, Delhi 110028', 'https://no.com', 'no@no.com', '9811694881', '9811694881', '2', '5', '10', '6', '5', '', '2022-10-15', '4', '18', '11', '', '8', '8', '8', '', 'Yes'),
(14, '2022-10-27 13:15:29', 'microcrm', '7', '2022-10-31', 'Abhyant Power Projects', 'Ghaziabad', 'https://abhyant.com/', 'abhyantpowers@gmail.com', '8510024008', '8510024008', '2', '5', '10', '4', '3', '', '2022-10-31', '4', '7', '6', '', '8', '8', '12', 'call to client after 30 november', 'Yes'),
(15, '2022-11-03 12:58:58', 'microcrm', '7', '2022-11-03', 'BVM Technologies Private Limited', 'Plot No. 40A, 5, Sahibabad Industrial Area Site 4, Sahibabad, Ghaziabad, Uttar Pradesh 201010', 'https://www.bvmtechnologies.com/', 'jsrajpoot@bvmtech.com', '8810444530', '8810444530', '2', '5', '10', '6', '5', '', '2022-11-03', '4', '7', '6', '', '8', '8', '8', 'Abhi requirement Nhi hai bt call after some time', 'Yes'),
(16, '2022-11-03 13:25:56', 'microcrm', '7', '2022-11-03', 'Dynamic Power Solutions', 'Plot No-3, 1334, Mainapur Rd, Industrial Area, Morta, Ghaziabad, Uttar Pradesh 201003', 'https://www.dynamicpower.in/', 'Info.dynamicpower@gmail.com', '9990068116', '9990068116', '2', '5', '10', '4', '3', '', '2022-11-03', '4', '7', '6', '', '8', '8', '7', 'call not pick', 'Yes'),
(17, '2022-11-03 13:34:50', 'microcrm', '7', '2022-11-03', 'M/S R Y B CONTROL SYSTEMS', 'Khasra No 1156,saraswati Vihar Shahid Ashram Road,pargana Loni,opp Dps School, Saddiq Nagar Meerut Road, Ghaziabad-201010, Uttar Pradesh, India', 'https://www.indiamart.com/rybcontrolsystems/profil', 'no@no.com', '7942566133', '7942566133', '2', '5', '9', '4', '3', '', '2022-11-03', '4', '7', '6', '', '8', '8', '7', 'call number not rechable', 'Yes'),
(18, '2022-11-03 13:52:40', 'microcrm', '7', '2022-11-03', 'Om Sai Solar Power System', 'Plot No- C 183, Sector 63, Noida', 'https://www.omsaisolarpowersystem.co.in/', 'info@omsaisolarpowersystem.in', '9999596127', '9999596127', '2', '5', '10', '6', '5', '', '2022-11-03', '4', '7', '7', '', '8', '8', '7', '', 'Yes'),
(20, '2022-11-03 15:12:22', 'microcrm', '7', '2022-11-03', 'Shree Nanak Automation & Solar System', 'H.NO.-1508, Anand Industrial Area Rd, G.Z.B, Ghaziabad, Uttar Pradesh 201007', 'https://www.indiamart.com/shreenanakautomationsola', 'no@no.com', '9899491208', '9899491208', '2', '5', '10', '6', '5', '', '2022-11-03', '4', '7', '6', '', '8', '8', '7', 'Abhi tho requirement nahi hai hogi tho btyunga', 'Yes'),
(21, '2022-11-03 15:19:41', 'microcrm', '7', '2022-11-03', 'New Continental Electricals', '35-C, Anand Industrial Estate Mohan Nagar, Ghaziabad-201007, Uttar Pradesh, India', 'https://www.indiamart.com/newcontinentalelectrical', 'ncelectricals@yahoo.co.in', '9810171816', '9810171816', '2', '5', '9', '6', '5', '', '2022-11-03', '4', '7', '6', '', '8', '8', '7', '', 'Yes'),
(22, '2022-11-03 15:26:09', 'microcrm', '7', '2022-11-03', 'Powerline Electric India (P) Ltd', 'D-6, Kavi Nagar Industrial Area,\r\nGhaziabad, Uttar Pradesh', 'https://www.powerlineelectricindia.com/', 'powerlineindia@gmail.com', '9871373955', '9891529612', '2', '5', '10', '4', '3', '', '2022-11-03', '4', '7', '6', '', '8', '8', '8', 'call to client', 'Yes'),
(23, '2022-11-03 15:33:13', 'microcrm', '7', '2022-11-03', 'Dreamz Automation Systems Pvt. Ltd.', '3/19, Block A, Loni Industrial Area, Ghaziabad, Uttar Pradesh 201007', 'https://dreamzautomation.com/', 'vinodpandey@dreamzautomation.com', '9811197698', '9811197698', '2', '5', '9', '6', '5', '', '2022-11-03', '4', '7', '6', '', '8', '8', '8', '', 'Yes'),
(24, '2022-11-03 15:48:42', 'microcrm', '7', '2022-11-03', 'ADVANCE POWER PROJECTS', 'Plot No-8, Sector 3, MDA, Meerut, Uttar Pradesh 250103', 'https://www.indiamart.com/advancepowerprojects', 'no@no.com', '9634179602', '9634179602', '2', '5', '10', '6', '5', '', '2022-11-03', '4', '7', '23', '', '8', '8', '8', '', 'Yes'),
(25, '2023-01-30 12:12:03', 'microcrm', '9', '2023-01-30', 'Jagat', 'Aa', 'https://www.g.com', '', '87502 71802', '87502 71802', '', '6', '11', '7', '6', '', '2023-01-30', '4', '18', '11', '', '9', '9', '8', '', 'Yes'),
(26, '2023-08-20 12:03:59', 'microcrm', '8', '2023-08-20', 'Rex', 'rex', 'https://www.microelectra.in/', 'fd@g.com', 'fd', 'gf', '', '5', '9', '4', '3', '', '2023-08-20', '4', '7', '6', '', '8', '8', '8', '', 'Yes'),
(27, '2023-10-09 11:46:13', 'microcrm', '11', '2023-10-25', 'Salience Commerce India Ltd', 'Gazipur', 'https://s.com', 'jpicollage1@gmail.com', '7007543270', '7007543270', '7', '', '', '4', '3', '', '2023-10-25', '4', '7', '6', '', '11', '11', '14', '', 'Yes'),
(28, '2023-10-09 11:48:51', 'microcrm', '11', '2023-10-09', 'Vignesh', 'Chennai', 'https://vig.com', 'tamilvignesh30@gmail.com', '9345184278', '9345184278', '5', '', '9', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'Ecommerce Website development \r\n30000 quote', 'Yes'),
(29, '2023-10-09 11:51:26', 'microcrm', '11', '2023-10-09', 'Aniket', 'Delhi', 'https://etf.com', 'whatsstatus143@gmail.com', '9540463906', '9540463906', '6', '', '9', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'MLM ayuratna final amount 40k final', 'Yes'),
(30, '2023-10-09 11:53:56', 'microcrm', '11', '2023-10-09', 'Satendra Sahu', 'Indore', 'https://wee.com', 'satyendrasahu00@gmail.com', '7247631096', '7247631096', '8', '', '9', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'Quality software', 'Yes'),
(31, '2023-10-09 11:55:49', 'microcrm', '11', '2023-10-18', 'SARASWATI INSTITUTE OF MEDICAL SCIENCE', 'Hapur', 'https://erer.com', 'dhram1981@gmail.com', '7830510500', '7830510500', '8', '', '', '4', '3', '', '2023-10-18', '4', '7', '6', '', '11', '11', '10', 'Purchase software', 'Yes'),
(32, '2023-10-09 11:57:58', 'microcrm', '11', '2023-10-09', 'Mine & Young (Neha Khatri)', 'Delhi', 'https://dfd.com', 'my@gmail.com', '9818340902', '9818340902', '5', '', '9', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'Ecommerce website', 'Yes'),
(33, '2023-10-09 12:00:09', 'microcrm', '11', '2023-10-18', 'Rohit Pandit', 'Tronica City Ghaziabad', 'https://fgf.com', 'mlmrohitpandey@gmail.com', '9718920175', '9718920175', '6', '', '', '4', '3', '', '2023-10-18', '4', '7', '6', '', '11', '11', '13', 'MLM Website 80k quote', 'Yes'),
(34, '2023-10-09 12:02:31', 'microcrm', '11', '2023-10-09', 'Rishi Raj', 'Darbhanga, Bihar', 'https://rtr.com', 'r@gmail.com', '9122347348', '9122347348', '5', '', '9', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'ecommerce website', 'Yes'),
(35, '2023-10-09 12:04:29', 'microcrm', '11', '2023-10-09', 'S J Organics', 'Meerut, Uttar pradesh', 'https://sjorganics.in/', 'sjvermicompost@gmail.com', '9760110595', '9760110595', '5', '', '9', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'ecommerce quote 45k', 'Yes'),
(36, '2023-10-09 12:08:41', 'microcrm', '11', '2023-10-03', 'Kavita Negi', 'delhi', 'https://rer.com', 'kavitasinghnegi1989@gmail.com', '8595227319', '8595227319', '5', '', '', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'ecommerce website', 'Yes'),
(37, '2023-10-09 12:11:20', 'microcrm', '7', '2023-10-09', 'Nidan Herbs Distributor LLP', 'Guwahati, Assam, India', 'https://ret.com', 'nidanherbs2016@gmail.com', '8638407127', '8638407127', '4', '8', '20', '4', '3', '', '2023-10-09', '4', '7', '6', '', '11', '11', '8', 'ecommerce website 1.10 Lakh Quote send', 'Yes'),
(38, '2023-10-09 16:01:53', 'microcrm', '11', '2023-10-09', 'WowCargopackaersmovers (Manoj)', 'Delhi', '', 'chouhanyogita178@gmail.com', '9958053329', '9958053329', '3', '8', '20', '4', '3', '', '2023-10-09', '4', '18', '19', '', '11', '11', '8', 'website', 'Yes'),
(39, '2023-10-10 22:31:36', 'microcrm', '11', '2023-10-16', 'Arvind Singh', 'Kota, Chhattisgarh', '', 'arvindsiris@gmail.com', '9660404102', '9660404102', '9', '8', '20', '4', '3', '', '2023-10-16', '4', '18', '11', '', '11', '11', '8', 'school software', 'Yes'),
(40, '2023-10-13 11:42:31', 'microcrm', '11', '2023-10-13', 'Rahul', 'Muzaffarpur, Bihar', '', 'sumankumarsoni@gmail.com', '8409458165', '8409458165', '6', '8', '20', '4', '3', '', '2023-10-13', '4', '18', '11', '', '11', '11', '8', 'mlm software', 'Yes'),
(41, '2023-10-16 16:54:34', 'microcrm', '11', '2023-10-16', 'Greater High Public School', 'Greater Noida', '', '', '7351082441', '7351082441', '9', '8', '20', '4', '3', '', '2023-10-16', '4', '7', '8', '', '11', '11', '8', 'School Software', 'Yes'),
(43, '2023-10-16 16:57:42', 'microcrm', '11', '2023-10-16', 'Holy Art School Nishant', 'Indore', '', 'nishant18haswani@gmail.com', '7000455081', '7000455081', '9', '8', '20', '4', '3', '', '2023-10-16', '4', '7', '6', '', '11', '11', '8', '', 'Yes'),
(44, '2023-10-16 17:02:02', 'microcrm', '11', '2023-10-16', 'Ms export and trading (Quershi)', 'Hapur', '', '', '7337517347', '7337517347', '8', '8', '20', '4', '3', '', '2023-10-16', '4', '7', '8', '', '11', '11', '8', 'App Hai Usme product dalne pe id aa jaye', 'Yes'),
(45, '2023-10-18 16:56:33', 'microcrm', '11', '2023-10-18', 'Abhilash', 'Aurangabad, Maharashtra', '', '', '8329996841', '08329996841', '7', '8', '20', '4', '3', '', '2023-10-18', '4', '7', '6', '', '11', '11', '12', 'Real Estate Plot EMI Software', 'Yes'),
(46, '2023-10-21 11:14:30', 'microcrm', '11', '2023-10-25', 'Parveen Sharma', 'Ghaziabad, Ramprast', '', 'praveen.sharma19941008@gmail.com', '8010381725', '8010381725', '5', '8', '20', '4', '3', '', '2023-10-25', '4', '7', '6', '', '11', '11', '8', 'Ecommerce 35k Quote laravel', 'Yes'),
(47, '2023-10-25 11:32:02', 'microcrm', '11', '2023-10-25', 'Resham Arora', 'Delhi', '', 'reshamarora6@gmail.com', '9899140488', '9899140488', '5', '8', '20', '4', '3', '', '2023-10-25', '4', '7', '6', '', '11', '11', '8', 'ecommerce abhi office main hu', 'Yes'),
(48, '2023-11-20 12:16:36', 'microcrm', '11', '2023-11-28', 'Tejas Om Avenue', 'Surendranagar, Gujarat', '', 'iamtejasjani@gmail.com', '7359043845', '7359043845', '7', '8', '20', '4', '3', '', '2023-11-28', '4', '19', '', '', '11', '11', '13', 'Real estate crm profile viewed', 'Yes'),
(49, '2023-11-28 15:39:47', 'microcrm', '11', '2023-11-28', 'Bharat Bhagat', 'Muzaffarpur', '', 'bharatbhagat7@gmail.com', '08825257886', '08825257886', '4', '8', '20', '4', '3', '', '2023-11-28', '4', '7', '6', '', '11', '11', '8', 'call on january', 'Yes'),
(50, '2023-11-28 15:43:16', 'microcrm', '11', '2023-11-28', 'Rajendra Jain', 'Alwar Rajisthan, Textile Software', '', 'taterrajendra21@gmail.com', '9829811071', '9829811071', '8', '8', '20', '4', '3', '', '2023-11-28', '4', '7', '6', '', '11', '11', '8', 'Textile software', 'Yes'),
(51, '2023-12-26 13:52:27', '', '', '2023-12-26', 'Balanl SEENU INDUSTRIES', 'Tiruvallur, Tamil Nadu, India', '', 'jayes1jayes@gmail.com', '9361056448', '9361056448', '3', '8', '20', '4', '3', '', '2023-12-26', '4', '7', '6', '', '11', '11', '8', '', 'Yes'),
(52, '2024-01-02 14:40:45', 'microcrm', '11', '2024-01-02', 'Shastri  NGO', 'HYDERABAD', '', '', '9849025100', '9849025100', '9', '8', '20', '4', '3', '', '2024-01-02', '4', '7', '6', '', '11', '11', '8', 'timetable', 'Yes'),
(53, '2024-01-02 14:46:33', 'microcrm', '11', '2024-01-02', 'DR Anil Saini', 'Saharanpur Micro Finance', '', '', '7017997070', '7017997070', '8', '8', '', '4', '3', '', '2024-01-02', '4', '7', '6', '', '11', '11', '8', 'micro group software quote 40k', 'Yes'),
(54, '2024-01-02 14:51:36', 'microcrm', '7', '2024-08-15', 'Kamlesh Darji', 'Mumbai', '', '', '9869423657', '09869423657', '8', '8', '20', '4', '3', '', '2024-08-15', '4', '7', '6', '', '11', '12', '8', 'inword CA software', 'Yes'),
(55, '2024-12-30 13:37:38', 'microcrm', '7', '2024-12-30', 'Physique Equipment Company', '9319251406', 'httpd://.no.com', 'physiquipment@yahoo.co.in', '9319251406', '9319251406', '3', '8', '20', '6', '5', '', '2024-12-30', '4', '7', '8', '', '8', '8', '8', '', 'Yes'),
(56, '2024-12-30 14:06:13', 'microcrm', '7', '2024-12-30', 'KAIDENSE AUTOMATION AND ELECTRICALS LLP', 'D-147, BLOCK -D, SECTOR-4, LAJPAT NAGAR, SAHIBAHAD, GHAZIABAD (UP) 201005', '', 'kaidense.automation@gmail.com', '9810820574', '9810820574', '3', '8', '20', '6', '5', '', '2024-12-30', '4', '7', '6', '', '8', '8', '8', 'Call next year mai karyenge abhi company start hui hai', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_lead_activity`
--

CREATE TABLE `mi_lead_activity` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `lead_id` varchar(10) NOT NULL,
  `act_date` date DEFAULT NULL,
  `act_type` varchar(50) DEFAULT NULL,
  `act_taken` mediumtext DEFAULT NULL,
  `file1` varchar(150) DEFAULT NULL,
  `file2` varchar(150) DEFAULT NULL,
  `file3` varchar(150) DEFAULT NULL,
  `plan_date` datetime DEFAULT NULL,
  `plan_action` mediumtext DEFAULT NULL,
  `plan_act_type` varchar(50) DEFAULT NULL,
  `plan_for` varchar(50) DEFAULT NULL,
  `lead_action` varchar(20) NOT NULL DEFAULT 'Not Completed',
  `act_by` varchar(20) DEFAULT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_lead_activity`
--

INSERT INTO `mi_lead_activity` (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `act_date`, `act_type`, `act_taken`, `file1`, `file2`, `file3`, `plan_date`, `plan_action`, `plan_act_type`, `plan_for`, `lead_action`, `act_by`, `mi_status`) VALUES
(1, '2022-10-07 18:35:09', 'microcrm', '7', '3', '2022-10-07', '7', 'Call to client he ask for quotation', NULL, NULL, NULL, '2022-10-08 12:10:28', 'Call back to client to take followup', '7', '8', 'Not Completed', NULL, 'Yes'),
(2, '2022-10-15 11:57:30', 'microcrm', '7', '13', '2022-10-15', '7', 'Call to client he said call me after diwali', NULL, NULL, NULL, '2022-10-28 11:10:24', 'Call to client he said call me after diwali : call for custom software or website development', '7', '8', 'Not Completed', NULL, 'Yes'),
(3, '2022-11-03 13:26:49', 'microcrm', '7', '16', '2022-11-03', '7', 'call not pick by client  call back on tomorrow', NULL, NULL, NULL, '2022-11-04 12:11:06', 'call back on tomorrow', '7', '8', 'Not Completed', NULL, 'Yes'),
(4, '2022-11-03 13:56:20', 'microcrm', '7', '18', '2022-11-03', '7', 'Call to client he said call for meeting', NULL, NULL, NULL, '2022-11-04 12:11:53', 'Call for Visit and demonstrate software', '3', '8', 'Not Completed', NULL, 'Yes'),
(5, '2022-11-03 14:06:31', 'microcrm', '7', '19', '2022-11-03', '7', 'call not pick by client', NULL, NULL, NULL, '2022-11-04 12:11:10', 'Call back', '7', '9', 'Not Completed', NULL, 'Yes'),
(6, '2022-11-03 15:21:21', 'microcrm', '7', '7', '2022-11-03', '7', 'Call to client not pick call', NULL, NULL, NULL, '2022-11-04 12:11:42', 'call back on tomorrow', '7', '8', 'Not Completed', NULL, 'Yes'),
(7, '2022-11-03 15:28:57', 'microcrm', '7', '22', '2022-11-03', '7', 'Call back on tomorrow call not pick', NULL, NULL, NULL, '2022-11-04 12:11:21', 'call back', '7', '8', 'Not Completed', NULL, 'Yes'),
(8, '2022-11-03 15:37:06', 'microcrm', '7', '23', '2022-11-03', '7', 'send me an email then we talk', NULL, NULL, NULL, '2022-11-04 12:11:22', 'send me an email regarding your product', '5', '8', 'Not Completed', NULL, 'Yes'),
(9, '2023-01-25 11:41:57', 'microcrm', '7', '4', '2023-01-25', '4', 'ca', NULL, NULL, NULL, '2023-01-25 11:41:29', 'ss', '4', '8', 'Not Completed', NULL, 'Yes'),
(10, '2023-01-27 15:59:44', 'microcrm', '7', '4', '2023-01-27', '3', 'Call', NULL, NULL, NULL, '2023-01-27 15:59:59', 'call again', '3', '8', 'Completed', '7', 'Yes'),
(11, '2023-01-27 16:00:37', 'microcrm', '7', '4', '2023-01-27', '4', 'Call', NULL, NULL, NULL, '2023-01-27 16:00:44', 'hh', '4', '8', 'Completed', '7', 'Yes'),
(12, '2023-01-27 16:00:41', 'microcrm', '7', '4', '2023-01-27', '7', 'again tomorrow', NULL, NULL, NULL, '2023-01-27 16:06:00', 'Ggg', '7', '8', 'Completed', '8', 'Yes'),
(13, '2023-01-27 16:02:55', 'microcrm', '7', '4', '2023-01-27', '3', 'ok', NULL, NULL, NULL, '2023-01-27 16:00:44', 'hh', '4', '8', 'Not Completed', NULL, 'Yes'),
(14, '2023-01-27 16:06:15', 'microcrm', '8', '4', '2023-01-27', '4', 'Yuu', NULL, NULL, NULL, '2023-01-27 16:06:00', 'Ggg', '7', '8', 'Not Completed', NULL, 'Yes'),
(15, '2023-01-30 13:27:44', 'microcrm', '9', '25', '2023-01-30', '7', 'Call to them his requirement is to make a app for english learning', NULL, NULL, NULL, '2023-01-30 13:28:31', 'Call back on tomorrow', '4', '9', 'Completed', '9', 'Yes'),
(16, '2023-01-30 13:29:28', 'microcrm', '9', '25', '2023-01-31', '7', 'Call back', NULL, NULL, NULL, '2023-01-31 15:43:42', 'He is not required', '7', '9', 'Completed', '9', 'Yes'),
(17, '2023-10-09 12:14:51', 'microcrm', '11', '27', '2023-10-09', '7', 'Discuss requirement property management software with emi and agent login section', NULL, NULL, NULL, '2023-10-09 03:10:14', 'Call followup', '7', '11', 'Not Completed', NULL, 'Yes'),
(18, '2023-10-09 12:20:12', 'microcrm', '11', '28', '2023-10-09', '7', 'Call on tomorrow for schedule meeting for ecommerce meeting', NULL, NULL, NULL, '2023-10-09 13:44:35', 'call on tomorrow for meeting', '7', '11', 'Completed', '7', 'Yes'),
(19, '2023-10-09 12:29:57', 'microcrm', '11', '29', '2023-10-09', '7', 'demo done ayuratna type mlm quote 40k', NULL, NULL, NULL, '2023-10-12 12:10:41', 'call to take followup abhi product aye ni hai', '7', '11', 'Not Completed', NULL, 'Yes'),
(20, '2023-10-09 12:31:58', 'microcrm', '11', '30', '2023-10-09', '7', 'call for online connect quality software data', NULL, NULL, NULL, '2023-10-10 12:10:40', 'call to take followup', '7', '11', 'Not Completed', NULL, 'Yes'),
(21, '2023-10-09 12:43:58', 'microcrm', '11', '31', '2023-10-09', '7', 'requirement gather send quotation', NULL, NULL, NULL, '2023-10-10 01:10:49', 'call for update for the meeting', '7', '11', 'Not Completed', NULL, 'Yes'),
(22, '2023-10-09 13:05:55', 'microcrm', '11', '32', '2023-10-09', '7', 'call not pick by client', NULL, NULL, NULL, '2023-10-10 01:10:15', 'Call back to take followup', '7', '11', 'Not Completed', NULL, 'Yes'),
(23, '2023-10-09 13:08:38', 'microcrm', '11', '33', '2023-10-09', '7', 'Trading Plan hai Quote 80K', NULL, NULL, NULL, '2023-10-10 01:10:27', 'call back to take followup patner se discuss karke btyunga', '7', '11', 'Not Completed', NULL, 'Yes'),
(24, '2023-10-09 13:21:53', 'microcrm', '11', '34', '2023-10-09', '7', 'Call to client he is in travel', NULL, NULL, NULL, '2023-10-10 01:10:26', 'Call to client he is in travel  call back', '7', '11', 'Not Completed', NULL, 'Yes'),
(25, '2023-10-09 13:22:50', 'microcrm', '11', '35', '2023-10-09', '7', 'Quotation send call to take followup', NULL, NULL, NULL, '2023-10-09 13:22:05', 'Quotation send call to take followup', '7', '11', 'Not Completed', NULL, 'Yes'),
(26, '2023-10-09 13:23:49', 'microcrm', '11', '36', '2023-10-09', '7', 'Call not pick', NULL, NULL, NULL, '2023-10-10 07:10:01', 'call not pick call back', '7', '11', 'Not Completed', NULL, 'Yes'),
(27, '2023-10-09 13:28:04', 'microcrm', '11', '37', '2023-10-09', '7', 'Quotation Send 1.10Lakh not make payment till now', NULL, NULL, NULL, '2023-10-09 06:10:47', 'Take followup for payment', '7', '11', 'Not Completed', NULL, 'Yes'),
(28, '2023-10-09 13:48:28', 'microcrm', '7', '28', '2023-10-10', '7', 'Call for meeting schedule', NULL, NULL, NULL, '2023-10-09 13:55:05', 'Call tomorrow', '4', '11', 'Completed', '7', 'Yes'),
(29, '2023-10-09 13:56:13', 'microcrm', '7', '28', '2023-10-10', '7', 'Call back', NULL, NULL, NULL, '2023-10-09 13:55:05', 'Call tomorrow', '4', '11', 'Not Completed', NULL, 'Yes'),
(30, '2023-10-09 16:02:34', 'microcrm', '11', '38', '2023-10-09', '7', 'Call to client not pick up call', NULL, NULL, NULL, '2023-10-10 08:10:57', 'Call to client not pick up call', '7', '11', 'Not Completed', NULL, 'Yes'),
(31, '2023-10-10 22:32:49', 'microcrm', '11', '39', '2023-10-10', '7', 'not make  call for school software', NULL, NULL, NULL, '2023-10-11 02:10:41', 'not make  call for school software call', '7', '11', 'Not Completed', NULL, 'Yes'),
(32, '2023-11-28 16:00:58', 'microcrm', '11', '50', '2023-11-28', '7', 'call abhi bimar hu', NULL, NULL, NULL, '2023-11-28 16:00:25', 'call', '7', '8', 'Completed', '7', 'Yes'),
(33, '2023-11-28 16:01:51', 'microcrm', '11', '50', '2023-11-28', '7', 'call', NULL, NULL, NULL, '2023-11-29 01:11:25', 'call for update', '7', '11', 'Completed', '11', 'Yes'),
(34, '2023-11-28 16:04:49', 'microcrm', '7', '50', '2023-11-28', '7', 'call', NULL, NULL, NULL, '2023-11-28 00:00:00', 'call', '7', '11', 'Completed', '7', 'Yes'),
(35, '2023-11-28 16:17:46', 'microcrm', '7', '50', '2023-11-29', '7', 'call', NULL, NULL, NULL, '2023-11-29 11:16:13', 'call', '', '11', 'Completed', '11', 'Yes'),
(36, '2023-11-29 11:16:11', 'microcrm', '11', '50', '2023-12-02', '7', 'call for update', NULL, NULL, NULL, '2023-12-02 00:00:00', 'call for update', '', '11', 'Not Completed', NULL, 'Yes'),
(37, '2024-01-02 14:42:02', 'microcrm', '11', '52', '2024-01-02', '7', 'call to client he said demo plan on 5 jan for timetable', NULL, NULL, NULL, '2024-07-18 00:53:52', 'Complete', '4', '11', 'Completed', '7', 'Yes'),
(38, '2024-01-02 14:47:24', 'microcrm', '11', '53', '2024-01-02', '7', 'call to client he said call me back', NULL, NULL, NULL, '2024-01-03 10:01:39', 'Call', '3', '8', 'Completed', '7', 'Yes'),
(39, '2024-01-02 14:52:23', 'microcrm', '11', '54', '2024-01-02', '7', 'Send profile to client and call', NULL, NULL, NULL, '2024-01-03 11:01:41', 'Calling', '8', '8', 'Completed', '7', 'Yes'),
(40, '2024-07-18 00:55:37', 'microcrm', '7', '54', '2024-07-18', '8', 'Calling', NULL, NULL, NULL, '2024-07-18 00:00:00', 'Calling', '', '8', 'Not Completed', NULL, 'Yes'),
(41, '2024-07-18 00:56:04', 'microcrm', '7', '53', '2024-07-18', '3', 'Call', NULL, NULL, NULL, '2024-07-18 00:00:00', 'Call', '', '8', 'Not Completed', NULL, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_lead_address`
--

CREATE TABLE `mi_lead_address` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `lead_id` varchar(50) NOT NULL,
  `address` mediumtext NOT NULL,
  `state` varchar(10) DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `gstin` varchar(20) DEFAULT NULL,
  `act_status` varchar(10) NOT NULL DEFAULT 'No',
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_lead_contacts`
--

CREATE TABLE `mi_lead_contacts` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `lead_id` varchar(10) NOT NULL,
  `desig_id` varchar(10) DEFAULT NULL,
  `dep_id` varchar(10) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `act_status` varchar(10) NOT NULL DEFAULT 'No',
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_lead_contacts`
--

INSERT INTO `mi_lead_contacts` (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `desig_id`, `dep_id`, `title`, `fname`, `lname`, `mobile`, `contact`, `email`, `act_status`, `mi_status`) VALUES
(1, '2022-10-10 14:56:16', 'microcrm', '7', '9', '5', '', 'Mr.', 'Manoj ', 'Kamboj', '9810217990', '9810217990', 'sales@ecscontrolpanel.com', 'No', 'Yes'),
(3, '2022-11-03 15:20:19', 'microcrm', '7', '7', '5', '', 'Mr.', 'Neeraj ', 'Kumar Chaudhary', '9810345148', '', '', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_lead_products`
--

CREATE TABLE `mi_lead_products` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `lead_id` varchar(10) NOT NULL,
  `prod_id` varchar(10) DEFAULT NULL,
  `qty` varchar(10) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `total` varchar(10) NOT NULL,
  `active_status` varchar(10) NOT NULL DEFAULT 'Not Active',
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_lead_products`
--

INSERT INTO `mi_lead_products` (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `prod_id`, `qty`, `rate`, `total`, `active_status`, `mi_status`) VALUES
(1, '2022-11-03 15:20:38', 'microcrm', '7', '7', '2', '1', '38000', '38000', 'Yes', 'Yes'),
(2, '2023-10-10 14:48:10', 'microcrm', '11', '27', '7', '1', '80000', '80000', 'Yes', 'Yes'),
(3, '2023-10-10 22:34:33', 'microcrm', '11', '39', '8', '1', '50000', '50000', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_lead_profile`
--

CREATE TABLE `mi_lead_profile` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `lead_id` varchar(50) NOT NULL,
  `panno` varchar(50) DEFAULT NULL,
  `gstin` varchar(50) DEFAULT NULL,
  `regno` varchar(50) DEFAULT NULL,
  `staxno` varchar(50) DEFAULT NULL,
  `faxno` varchar(50) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `dealsin` mediumtext DEFAULT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_lead_profile`
--

INSERT INTO `mi_lead_profile` (`id`, `rdate`, `cmp_id`, `user_id`, `lead_id`, `panno`, `gstin`, `regno`, `staxno`, `faxno`, `remark`, `dealsin`, `mi_status`) VALUES
(1, '2022-10-27 12:54:28', 'microcrm', '7', '2', '', '09ABSFS4326A1Z3', '09ABSFS4326A1Z3', '', '', '', 'Automatic Changeover Switches,AMF Panel,Submersible Panel,Smart Digital Motor Starter,Control Panel,Automatic Battery Charger,Water Level Controller,Digital Current Limiting Device,Programmable Time Switches,Limit Switch,Current Limiting Devices,Water Tank Automation System,Power Management System,Generator Auto Changeover,Tank Automation System,123456 789456 123456 789 456 123321 4564564,power management system', 'Yes'),
(2, '2022-10-31 13:00:19', 'microcrm', '7', '14', '', '09ABOFA8541P1ZL', '', '', '', '', 'Control Panel,LT Panel,Electrical Panel,Distribution Board,Synchronizing Panels', 'Yes'),
(3, '2022-11-03 13:01:42', 'microcrm', '7', '15', '', '9AADCB0375M1ZH', '', '', '', '', 'Company secondary substation,HT VCB Control Panels,Distribution Transformers,Power Distribution Panel,HT Panel,Ring Main Unit', 'Yes'),
(4, '2022-11-03 13:36:11', 'microcrm', '7', '17', '', '09AMVPK7226R1ZW', '', '', '', '', 'Control Panel,Distribution Panel,Ring Main Unit,Lt Panel,Ht Electrical Panels,Electrical Panel', 'Yes'),
(5, '2022-11-03 13:55:22', 'microcrm', '7', '18', '', '09FCIPS7280D1Z4', '', '', '', '', 'Electrical Panel,VFD,Solar Street Light,Solar Inverter,Surge Protective Device,Ht Feeder Pillar,Plc Control Panel,AC Combiner Box,Electrical Junction Box,PV Modules,Octagonal Pole', 'Yes'),
(6, '2022-11-03 14:06:02', 'microcrm', '7', '19', '', '09FFQPS1627D1Z3', '', '', '', '', 'PCC Panel,AMF Panel,DG Synchronizing Panel,Panel Installation Services,Motor Starter Panels,Outdoor Power Panel,Moter Drive Panel', 'Yes'),
(7, '2022-11-03 15:14:29', 'microcrm', '7', '20', '', '09ATAPC7878D1ZM', '', '', '', '', 'Control Panel,Solar DCDB And ACDB,Distribution Panel,Meter Panel Board,Solar Acdb Dcdb Box,Lt Distribution Panels,Solar Array Junction Box,Electric And Changeover Panel,Lt Meter Panel,Control Panels Capacitor,Three Phase Motor Control Panel', 'Yes'),
(8, '2022-11-03 15:28:16', 'microcrm', '7', '22', '', '09AAFCP2295L1ZW', '', '', '', '', 'Transformers,Vacuum Circuit Breaker,Current Transformers,Voltage Transformers,Lighting Arrestors,Isolators', 'Yes'),
(9, '2022-11-03 15:34:38', 'microcrm', '7', '23', '', '', '', '', '', '', 'PLC,Control Panel,Distribution Panel,HMI,Frequency Converter (Drives)', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_location`
--

CREATE TABLE `mi_location` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_location`
--

INSERT INTO `mi_location` (`id`, `rdate`, `cmp_id`, `user_id`, `state`, `location`, `mi_status`) VALUES
(1, '2022-09-15 22:22:26', 'aadya', '1', '1', 'Lucknow', 'Yes'),
(2, '2022-09-15 22:22:26', 'aadya', '1', '1', 'dadri', 'Yes'),
(4, '2022-09-16 19:45:59', 'aadya', '1', '5', 'Muzaffarpur', 'Yes'),
(5, '2022-09-16 19:46:06', 'aadya', '1', '5', 'Patna', 'Yes'),
(6, '2022-10-06 17:59:52', 'microcrm', '7', '7', 'Ghaziabad', 'Yes'),
(7, '2022-10-06 17:59:52', 'microcrm', '7', '7', 'Noida', 'Yes'),
(8, '2022-10-06 17:59:52', 'microcrm', '7', '7', 'Greater Noida', 'Yes'),
(9, '2022-10-06 18:00:20', 'microcrm', '7', '15', 'Gurugram', 'Yes'),
(10, '2022-10-06 18:00:20', 'microcrm', '7', '15', 'Faridabad', 'Yes'),
(11, '2022-10-07 12:00:47', 'microcrm', '7', '18', 'Jasola Vihar', 'Yes'),
(12, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Bawana Industrial Area', 'Yes'),
(13, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Patparganj industrial area', 'Yes'),
(14, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Mayur Vihar ', 'Yes'),
(15, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Ashok Vihar', 'Yes'),
(16, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Ashok Nagar', 'Yes'),
(17, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Rohini', 'Yes'),
(18, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Kirti Nagar', 'Yes'),
(19, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'Anand Vihar', 'Yes'),
(20, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'MAYAPURI PHASE-1, Industrial Area', 'Yes'),
(21, '2022-10-07 12:05:09', 'microcrm', '7', '18', 'All', 'Yes'),
(22, '2022-10-10 14:28:32', 'microcrm', '7', '7', 'Hapur', 'Yes'),
(23, '2022-11-03 15:48:58', 'microcrm', '7', '7', 'Meerut', 'Yes'),
(24, '2023-11-25 14:48:21', 'microcrm', '7', '9', 'Jaipur', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_module`
--

CREATE TABLE `mi_module` (
  `id` int(11) NOT NULL,
  `m_grp_code` varchar(60) NOT NULL,
  `m_grp_name` varchar(60) NOT NULL,
  `m_code` varchar(50) NOT NULL,
  `m_name` varchar(60) NOT NULL,
  `m_page_name` varchar(60) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_module`
--

INSERT INTO `mi_module` (`id`, `m_grp_code`, `m_grp_name`, `m_code`, `m_name`, `m_page_name`, `mi_status`) VALUES
(4, '', 'Company Setting', 'setting', 'Company Setting', '', 'Yes'),
(12, '', 'Inventory & Billing', 'inventory', 'Inventory & Billing', '', 'Yes'),
(13, '', 'HR & Payroll', 'hr_payroll', 'HR & Payroll', '', 'No'),
(16, '', 'Work', 'work', 'Work', '', 'No'),
(17, '', 'Sales', 'sales', 'Sales', '', 'Yes'),
(18, '', 'Report', 'report', 'Report', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_module_assign`
--

CREATE TABLE `mi_module_assign` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `reseller_id` varchar(50) NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `module_id` mediumtext NOT NULL,
  `feature_id` mediumtext NOT NULL,
  `auth_status` varchar(10) NOT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_module_assign`
--

INSERT INTO `mi_module_assign` (`id`, `rdate`, `reseller_id`, `cmp_id`, `module_id`, `feature_id`, `auth_status`, `mi_status`) VALUES
(1, '2022-02-15 23:03:08', 'microelectra', 'aadya', 'setting,sales', 'branch,department,designation,newlead,lead,billing,stkitem,party,unit,category,job,po', 'Yes', 'Yes'),
(4, '2022-10-06 17:05:00', 'microelectra', 'microcrm', 'setting,sales,report', 'branch,department,designation,newlead,lead,pending_lead,new-lead-report,billing,stkitem,party,unit,category,job,po', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_party`
--

CREATE TABLE `mi_party` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `sess_year` varchar(20) NOT NULL,
  `party_type` varchar(10) NOT NULL,
  `party_name` varchar(100) NOT NULL,
  `gstin` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` mediumtext NOT NULL,
  `other_detail` mediumtext NOT NULL,
  `image` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_product`
--

CREATE TABLE `mi_product` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `cat_id` varchar(50) NOT NULL,
  `i_code` varchar(50) DEFAULT NULL,
  `item_name` varchar(100) NOT NULL,
  `hsncode` varchar(50) DEFAULT NULL,
  `prate` varchar(10) DEFAULT NULL,
  `rate` varchar(10) DEFAULT NULL,
  `unit_id` varchar(10) NOT NULL,
  `op_qty` varchar(10) NOT NULL DEFAULT '0',
  `gst` varchar(10) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_product`
--

INSERT INTO `mi_product` (`id`, `rdate`, `cmp_id`, `user_id`, `cat_id`, `i_code`, `item_name`, `hsncode`, `prate`, `rate`, `unit_id`, `op_qty`, `gst`, `description`, `image`, `mi_status`) VALUES
(1, '2022-09-26 16:43:04', 'aadya', '1', '2', 'P001', '100KVA (SUPERNOVA VECV SERIES)', '87545', '1500', '1900', '2', '', '18', 'ok', 'aadya_1.jpg', 'Yes'),
(2, '2022-10-06 18:08:01', 'microcrm', '7', '3', '001', 'Sales Software', '0023', '38000', '38000', '3', '', '18', 'Sales software', '', 'Yes'),
(3, '2023-01-30 10:54:22', 'microcrm', '7', '4', '002', 'Website', '00321', '12000', '12000', '3', '', '18', '', '', 'Yes'),
(4, '2023-10-09 13:29:58', 'microcrm', '7', '4', '004', 'Multi Vendor Ecommerce Development', '004445', '99000', '99999', '3', '', '18', 'Multi Vendor Ecommerce Development', '', 'Yes'),
(5, '2023-10-09 13:30:37', 'microcrm', '7', '4', '004', 'Ecommerce Development', '005545', '40000', '40000', '3', '', '18', '', '', 'Yes'),
(6, '2023-10-09 13:31:15', 'microcrm', '7', '3', '005', 'MLM Software', 'g4554534', '60000', '60000', '3', '', '18', '', '', 'Yes'),
(7, '2023-10-09 13:31:53', 'microcrm', '7', '3', '065565', 'Real Estate CRM software', '45', '80000', '80000', '3', '', '18', '', '', 'Yes'),
(8, '2023-10-09 13:32:41', 'microcrm', '7', '3', '0565', 'Custom Software', '546546', '50000', '50000', '3', '', '18', 'Custom Software', '', 'Yes'),
(9, '2023-10-16 16:44:15', 'microcrm', '7', '3', '0067', 'School Management Software', '4553', '40000', '40000', '3', '', '18', '', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_purchase`
--

CREATE TABLE `mi_purchase` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `inv_no` varchar(100) NOT NULL,
  `inv_date` date NOT NULL,
  `party_id` varchar(10) NOT NULL,
  `gtotal` varchar(20) NOT NULL,
  `ggsttotal` varchar(20) NOT NULL,
  `gsubtotal` varchar(20) NOT NULL,
  `fright` varchar(20) NOT NULL,
  `adjustment` varchar(20) NOT NULL,
  `nettotal` varchar(20) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `pdetail` mediumtext NOT NULL,
  `remark` mediumtext NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_purchase_detail`
--

CREATE TABLE `mi_purchase_detail` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `inv_id` varchar(20) NOT NULL,
  `inv_no` varchar(50) NOT NULL,
  `cat_id` varchar(20) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `rate` varchar(20) NOT NULL,
  `drate` varchar(20) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `unit_id` varchar(10) NOT NULL,
  `total` varchar(25) NOT NULL,
  `gst` varchar(25) NOT NULL,
  `gsttotal` varchar(25) NOT NULL,
  `subtotal` varchar(25) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mi_reference`
--

CREATE TABLE `mi_reference` (
  `id` int(11) NOT NULL,
  `rdate` datetime DEFAULT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_reference`
--

INSERT INTO `mi_reference` (`id`, `rdate`, `cmp_id`, `user_id`, `source`, `reference`, `mi_status`) VALUES
(2, '2022-09-15 18:41:24', 'aadya', '1', '2', 'Facebook', 'Yes'),
(3, '2022-10-06 17:55:19', 'microcrm', '7', '4', 'Indiamart', 'Yes'),
(4, '2022-10-06 17:55:34', 'microcrm', '7', '5', 'Email shoot', 'Yes'),
(5, '2022-10-06 17:55:46', 'microcrm', '7', '6', 'Call', 'Yes'),
(6, '2022-10-06 17:56:02', 'microcrm', '7', '7', 'Justdial', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_region`
--

CREATE TABLE `mi_region` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `region_name` varchar(50) NOT NULL,
  `head_name` varchar(50) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_region`
--

INSERT INTO `mi_region` (`id`, `rdate`, `cmp_id`, `user_id`, `region_name`, `head_name`, `address`, `phone`, `fax`, `email`, `description`, `mi_status`) VALUES
(2, '2022-09-09 15:41:58', 'aadya', '1', 'Delhi', '', 'Delhi', '08826831843', '123456789', 'krisoft03@gmail.com', 'ok', 'Yes'),
(3, '2022-09-09 15:49:18', 'aadya', '1', 'UP', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes'),
(4, '2022-09-09 15:49:27', 'aadya', '1', 'BIhar', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes'),
(8, '2022-10-06 17:47:15', 'microcrm', '7', 'All', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes'),
(9, '2024-08-15 19:59:22', 'microcrm', '7', 'North Zone', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_reseller`
--

CREATE TABLE `mi_reseller` (
  `id` int(11) NOT NULL,
  `rdate` date NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `city` varchar(70) NOT NULL,
  `company` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `exp_date` date NOT NULL,
  `renew_amt` varchar(10) NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_reseller`
--

INSERT INTO `mi_reseller` (`id`, `rdate`, `user_id`, `user_name`, `email`, `mobile`, `city`, `company`, `address`, `amount`, `exp_date`, `renew_amt`, `description`, `image`, `mi_status`) VALUES
(4, '2019-10-14', 'microelectra', 'Bhagwan Babu', 'bhagwanbabu81@gmail.com', '9899816353', 'Dadri', 'Microelectra IT corporation', 'Dadri', '25000', '2023-10-14', '5000', '', '4.jpeg', 'Yes'),
(5, '2022-02-14', 'sanjeev', 'Sanjeev Kumar', 'gurukivanisms@gmail.com', '9654220512', 'Dadupur', 'R. N. Public School', '', '80000', '2023-02-14', '8000', '', '5.jpg', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `mi_role`
--

CREATE TABLE `mi_role` (
  `id` int(11) NOT NULL,
  `role_code` varchar(50) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_role`
--

INSERT INTO `mi_role` (`id`, `role_code`, `role_name`, `mi_status`) VALUES
(1, 'SUPERADMIN', 'Super Admin', 'Yes'),
(2, 'ADMIN', 'Reseller', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_role_rights`
--

CREATE TABLE `mi_role_rights` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `emp_id` varchar(10) DEFAULT NULL,
  `rr_page_code` varchar(100) NOT NULL,
  `rr_create` varchar(10) NOT NULL,
  `rr_edit` varchar(10) NOT NULL,
  `rr_delete` varchar(10) NOT NULL,
  `rr_view` varchar(10) NOT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_role_rights`
--

INSERT INTO `mi_role_rights` (`id`, `rdate`, `cmp_id`, `user_id`, `emp_id`, `rr_page_code`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`, `mi_status`) VALUES
(12, '2022-09-13 19:23:39', 'aadya', '1', '6', 'category', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(11, '2022-09-13 19:23:39', 'aadya', '1', '6', 'unit', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(10, '2022-09-13 19:23:39', 'aadya', '1', '6', 'party', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(9, '2022-09-13 19:23:39', 'aadya', '1', '6', 'stkitem', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(8, '2022-09-13 19:23:39', 'aadya', '1', '6', 'billing', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(13, '2022-09-13 19:23:39', 'aadya', '1', '6', 'job', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(14, '2022-09-13 19:23:39', 'aadya', '1', '6', 'po', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(34, '2024-07-21 18:01:08', 'microcrm', '7', '8', 'designation', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(33, '2024-07-21 18:01:08', 'microcrm', '7', '8', 'department', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(32, '2024-07-21 18:01:08', 'microcrm', '7', '8', 'branch', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(29, '2023-11-28 15:49:58', 'microcrm', '7', '9', 'designation', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(28, '2023-11-28 15:49:58', 'microcrm', '7', '9', 'department', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(27, '2023-11-28 15:49:58', 'microcrm', '7', '9', 'branch', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(23, '2023-08-19 19:54:05', 'microcrm', '7', '10', 'lead', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(24, '2023-08-19 19:54:05', 'microcrm', '7', '10', 'new-lead-report', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(25, '2023-10-09 11:40:49', 'microcrm', '7', '11', 'lead', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(26, '2023-10-09 11:40:49', 'microcrm', '7', '11', 'new-lead-report', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(30, '2023-11-28 15:49:58', 'microcrm', '7', '9', 'lead', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(31, '2023-11-28 15:49:58', 'microcrm', '7', '9', 'new-lead-report', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(35, '2024-07-21 18:01:08', 'microcrm', '7', '8', 'pending_lead', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(36, '2024-07-21 18:01:08', 'microcrm', '7', '8', 'lead', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(37, '2024-08-15 20:05:39', 'microcrm', '7', '12', 'pending_lead', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(38, '2024-08-15 20:05:39', 'microcrm', '7', '12', 'lead', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes'),
(39, '2024-08-15 20:05:39', 'microcrm', '7', '12', 'new-lead-report', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_segment`
--

CREATE TABLE `mi_segment` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `industry` varchar(10) NOT NULL,
  `segment` varchar(100) NOT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_segment`
--

INSERT INTO `mi_segment` (`id`, `rdate`, `cmp_id`, `user_id`, `industry`, `segment`, `mi_status`) VALUES
(4, '2022-09-15 16:36:03', 'aadya', '1', '3', 'Segment1', 'Yes'),
(6, '2022-09-15 18:20:51', 'aadya', '1', '3', 'Segment20', 'Yes'),
(7, '2022-09-27 15:38:13', 'aadya', '1', '1', 'Material 1', 'Yes'),
(8, '2022-09-27 15:38:13', 'aadya', '1', '1', 'Material 2', 'Yes'),
(9, '2022-10-06 17:51:54', 'microcrm', '7', '5', 'Automation', 'Yes'),
(10, '2022-10-06 17:52:07', 'microcrm', '7', '5', 'Electrical Panel', 'Yes'),
(11, '2022-10-07 12:16:09', 'microcrm', '7', '6', 'Medical Equipments ', 'Yes'),
(16, '2022-10-07 12:21:40', 'microcrm', '7', '6', 'ICU Equipments', 'Yes'),
(17, '2022-10-07 12:33:31', 'microcrm', '7', '5', 'Transformer', 'Yes'),
(18, '2023-08-19 18:40:00', 'microcrm', '7', '7', 'School', 'Yes'),
(19, '2023-08-19 18:40:00', 'microcrm', '7', '7', 'Play School', 'Yes'),
(20, '2023-10-09 13:43:14', 'microcrm', '7', '8', 'Common', 'Yes'),
(21, '2024-08-15 20:43:28', 'microcrm', '7', '10', 'Control Panel', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_source`
--

CREATE TABLE `mi_source` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `source` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_source`
--

INSERT INTO `mi_source` (`id`, `rdate`, `cmp_id`, `user_id`, `source`, `mi_status`) VALUES
(2, '2022-09-15 18:09:00', 'aadya', '1', 'E-mail', 'Yes'),
(3, '2022-09-16 19:48:16', 'aadya', '1', 'By Phone', 'Yes'),
(4, '2022-10-06 17:53:16', 'microcrm', '7', 'Indiamart', 'Yes'),
(5, '2022-10-06 17:53:16', 'microcrm', '7', 'Email', 'Yes'),
(6, '2022-10-06 17:53:16', 'microcrm', '7', 'Call', 'Yes'),
(7, '2022-10-06 17:53:16', 'microcrm', '7', 'Justdial', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_state`
--

CREATE TABLE `mi_state` (
  `id` int(11) NOT NULL,
  `rdate` datetime DEFAULT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `country` varchar(10) DEFAULT NULL,
  `state` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_state`
--

INSERT INTO `mi_state` (`id`, `rdate`, `cmp_id`, `user_id`, `country`, `state`, `mi_status`) VALUES
(1, '2022-09-15 20:42:04', 'aadya', '1', '2', 'U.P.', 'Yes'),
(5, '2022-09-16 19:43:54', 'aadya', '1', '2', 'Bihar', 'Yes'),
(6, '2022-09-16 19:47:44', 'aadya', '1', '3', 'Colmbo', 'Yes'),
(7, '2023-10-09 13:33:41', 'microcrm', '7', '4', 'Uttar Pradesh', 'Yes'),
(8, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Madhya Pradesh', 'Yes'),
(9, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Rajisthan', 'Yes'),
(10, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Karnataka', 'Yes'),
(11, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Maharashtra', 'Yes'),
(12, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Uttrakhand', 'Yes'),
(13, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Himachal Pradesh', 'Yes'),
(14, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Punjab', 'Yes'),
(15, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Haryana', 'Yes'),
(16, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Orrisa', 'Yes'),
(17, '2022-10-06 17:59:20', 'microcrm', '7', '4', 'Assam', 'Yes'),
(18, '2022-10-06 18:00:41', 'microcrm', '7', '4', 'Delhi ', 'Yes'),
(19, '2023-10-09 13:38:02', 'microcrm', '7', '4', 'Gujarat', 'Yes'),
(20, '2023-10-09 13:38:02', 'microcrm', '7', '4', 'West Bengal', 'Yes'),
(21, '2023-10-09 13:38:02', 'microcrm', '7', '4', 'Odisha', 'Yes'),
(22, '2023-10-09 13:38:02', 'microcrm', '7', '4', 'Tamil Nadu', 'Yes'),
(23, '2023-10-09 13:38:02', 'microcrm', '7', '4', 'Kerala', 'Yes'),
(24, '2023-10-09 13:38:44', 'microcrm', '7', '4', 'Andhra Pradesh', 'Yes'),
(25, '2023-10-09 13:39:32', 'microcrm', '7', '4', 'Mizoram', 'Yes'),
(26, '2023-10-09 13:42:12', 'microcrm', '7', '4', 'Tripura', 'Yes'),
(27, '2023-10-09 13:39:32', 'microcrm', '7', '4', 'Nagaland', 'Yes'),
(28, '2023-10-09 13:40:01', 'microcrm', '7', '4', 'Jharkhand', 'Yes'),
(29, '2023-10-09 13:40:29', 'microcrm', '7', '4', 'Manipur', 'Yes'),
(30, '2023-10-09 13:40:41', 'microcrm', '7', '4', 'Sikkim', 'Yes'),
(31, '2023-10-09 13:40:56', 'microcrm', '7', '4', 'Arunachal Pradesh', 'Yes'),
(32, '2023-10-09 13:41:19', 'microcrm', '7', '4', 'Meghalya', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_sys_user`
--

CREATE TABLE `mi_sys_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(70) NOT NULL,
  `user_auth` varchar(50) NOT NULL,
  `role_code` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_sys_user`
--

INSERT INTO `mi_sys_user` (`id`, `user_id`, `user_name`, `user_auth`, `role_code`, `mi_status`) VALUES
(1, 'admin', 'MicroElectra', 'Password@1612', 'SUPERADMIN', 'Yes'),
(5, 'microelectra', 'Bhagwan Babu', 'Password@1612', 'ADMIN', 'Yes'),
(6, 'sanjeev', 'R.N. Public School', '1234', 'ADMIN', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_task_type`
--

CREATE TABLE `mi_task_type` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `task_type` varchar(100) NOT NULL,
  `mi_status` varchar(10) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_task_type`
--

INSERT INTO `mi_task_type` (`id`, `rdate`, `cmp_id`, `user_id`, `task_type`, `mi_status`) VALUES
(1, '2022-09-16 14:59:57', 'aadya', '1', 'Appointment', 'Yes'),
(4, '2023-10-18 16:51:55', 'microcrm', '7', 'Call', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_transport_mode`
--

CREATE TABLE `mi_transport_mode` (
  `id` int(11) NOT NULL,
  `rdate` datetime DEFAULT NULL,
  `cmp_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `transport_mode` varchar(100) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mi_transport_mode`
--

INSERT INTO `mi_transport_mode` (`id`, `rdate`, `cmp_id`, `user_id`, `transport_mode`, `mi_status`) VALUES
(1, '2022-09-16 14:47:46', 'aadya', 'aadya', 'By Phone', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_unit`
--

CREATE TABLE `mi_unit` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_unit`
--

INSERT INTO `mi_unit` (`id`, `rdate`, `cmp_id`, `user_id`, `unit_name`, `description`, `mi_status`) VALUES
(1, '2022-08-24 19:34:11', 'microdemo', '1', 'Pieces', '', 'Yes'),
(2, '2022-09-26 16:39:20', 'aadya', '1', 'pcs', 'Pieces', 'Yes'),
(3, '2022-10-06 18:06:52', 'microcrm', '7', 'Nos', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `mi_user`
--

CREATE TABLE `mi_user` (
  `id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `cmp_id` varchar(100) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `user_type` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `emp_code` varchar(50) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` mediumtext NOT NULL,
  `smtp_email` varchar(50) DEFAULT NULL,
  `smtp_pwd` varchar(50) DEFAULT NULL,
  `email1` varchar(50) DEFAULT NULL,
  `email2` varchar(50) DEFAULT NULL,
  `other_detail` mediumtext NOT NULL,
  `image` varchar(50) NOT NULL,
  `mi_status` varchar(5) NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mi_user`
--

INSERT INTO `mi_user` (`id`, `rdate`, `cmp_id`, `user_id`, `user_type`, `username`, `emp_id`, `pwd`, `emp_code`, `division`, `region`, `branch`, `designation`, `doj`, `experience`, `dob`, `gender`, `email`, `mobile`, `phone`, `address`, `smtp_email`, `smtp_pwd`, `email1`, `email2`, `other_detail`, `image`, `mi_status`) VALUES
(1, '2022-02-15 23:01:32', 'aadya', NULL, 'Admin', 'Aadya', 'aadya', '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8826831843', NULL, 'Dadri', NULL, NULL, NULL, NULL, '', 'microdemo.png', 'Yes'),
(5, '2022-09-13 14:38:00', 'aadya', '1', 'User', 'Sumit Arya', 'sumit', '12345', 's001', 'Services', '2', '1', '2', '2022-09-13', '7 Years', '2004-09-13', 'Male', 'krisoft04@gmail.com', '8826731843', '9899816353', 'Dadri', 'krisoft04@gmail.com', 'krisoft03@gmail.com', 'krisoft03@gmail.com', 'krisoft03@gmail.com', 'ok', 'aadya_5.jpeg', 'Yes'),
(6, '2022-09-13 14:54:30', 'aadya', '1', 'User', 'Amit Kumar', 'amit', '12345', 'A001', 'Sales', '2', '2', '2', '2022-09-13', '7 years', '2004-09-13', 'Male', 'krisoft13@gmail.com', '8826231843', '', 'Dadri', 'krisoft13@gmail.com', 'krisoft03@gmail.com', 'krisoft03@gmail.com', 'krisoft03@gmail.com', '', '', 'Yes'),
(7, '2022-10-06 16:57:14', 'microcrm', 'microelectra', 'Admin', 'Admin', 'admin', '12345', '', 'Services', '8', '3', '6', '2022-10-06', '', '2004-10-06', NULL, 'rexsoft01@gmail.com', '8130576962', '', 'Tilapta karanwas', 'rexsoft01@gmail.com', 'rexsoft01@gmail.com', NULL, NULL, '', 'microcrm.jpg', 'Yes'),
(8, '2022-10-06 17:50:30', 'microcrm', '7', 'User', 'Neeraj Mathur', 'Sales1', '12345', '', 'Sales', '8', '3', '3', '2022-10-06', '', '2004-10-06', 'Male', 'rexsoft05@gmail.com', '8130576963', '', 'A-43 defence empire II, Tillapta karanwas greater noida', 'rexsoft01@gmail.com', 'rexsoft01@gmail.com', 'rexsoft01@gmail.com', 'rexsoft01@gmail.com', '', '', 'Yes'),
(9, '2022-10-07 18:42:35', 'microcrm', '7', 'User', 'Bhagwan Rana', 'Sales2', '12345', '001', 'Sales', '8', '3', '3', '2022-10-07', '', '2004-10-07', 'Male', 're@gmail.com', '9899816353', '', '', 'rexsoft0145@gmail.com', 'rexsoft0145@gmail.com', '', '', '', '', 'Yes'),
(10, '2023-08-19 19:47:45', 'microcrm', '7', 'User', 'Neeraj Babu', 'rexsoft01@gmail.com', '12345', '004', 'Sales', '8', '3', '4', '2023-08-18', '', '2005-08-18', 'Male', 'rexsoft04@gmail.com', '8130576964', '', 'A-43 defence empire II, Tillapta karanwas greater noida', 'rexsoft04@gmail.com', 'rexsoft04@gmail.com', 'rexsoft04@gmail.com', 'rexsoft01@gmail.com', '', '', 'Yes'),
(11, '2023-10-09 11:40:33', 'microcrm', '7', 'User', 'Kajal Mathur', 'kajal@gmail.com', '12345', '004', 'Sales', '8', '3', '3', '2023-10-09', '', '2005-10-09', 'Female', 'kajal@gmail.com', '8130576766', '', '', 'kajal@gmail.com', 'kajal@gmail.com', '', '', '', '', 'Yes'),
(12, '2024-08-15 20:05:13', 'microcrm', '7', 'User', 'Suresh Sharma', '9868674536', '12345', '00545', 'Sales', '9', '4', '3', '2024-08-16', '4+ in Sales', '2006-08-15', 'Male', 'rexsoft01xxx@gmail.com', '9868674536', '8130576962', 'A43 defence empire2', 'rexsoft013@gmail.com', 'rexsoft013@gmail.com', 'rexsoft01@gmail.com', 'rexsoft01@gmail.com', '', '', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mi_billing`
--
ALTER TABLE `mi_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_billing_detail`
--
ALTER TABLE `mi_billing_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_branch`
--
ALTER TABLE `mi_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `branch_name` (`branch_name`);

--
-- Indexes for table `mi_category`
--
ALTER TABLE `mi_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `cat_name` (`cat_name`);

--
-- Indexes for table `mi_cmp_profile`
--
ALTER TABLE `mi_cmp_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `mi_company`
--
ALTER TABLE `mi_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_url` (`cmp_url`),
  ADD KEY `id` (`id`) USING BTREE,
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `cmp_url` (`cmp_url`);

--
-- Indexes for table `mi_complaint_nature`
--
ALTER TABLE `mi_complaint_nature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_country`
--
ALTER TABLE `mi_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_department`
--
ALTER TABLE `mi_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `dep_name` (`department_name`);

--
-- Indexes for table `mi_designation`
--
ALTER TABLE `mi_designation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `designation` (`designation`);

--
-- Indexes for table `mi_desig_authority`
--
ALTER TABLE `mi_desig_authority`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `desig_id` (`desig_id`);

--
-- Indexes for table `mi_emp_juniors`
--
ALTER TABLE `mi_emp_juniors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `mi_enquiry_status`
--
ALTER TABLE `mi_enquiry_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_expense_head`
--
ALTER TABLE `mi_expense_head`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_feature`
--
ALTER TABLE `mi_feature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_code` (`m_code`),
  ADD KEY `f_code` (`f_code`);

--
-- Indexes for table `mi_followup_type`
--
ALTER TABLE `mi_followup_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_industry`
--
ALTER TABLE `mi_industry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_item`
--
ALTER TABLE `mi_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_job`
--
ALTER TABLE `mi_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_job_detail`
--
ALTER TABLE `mi_job_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_lead`
--
ALTER TABLE `mi_lead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_lead_activity`
--
ALTER TABLE `mi_lead_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_lead_address`
--
ALTER TABLE `mi_lead_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Indexes for table `mi_lead_contacts`
--
ALTER TABLE `mi_lead_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_lead_products`
--
ALTER TABLE `mi_lead_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Indexes for table `mi_lead_profile`
--
ALTER TABLE `mi_lead_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_location`
--
ALTER TABLE `mi_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `state` (`state`);

--
-- Indexes for table `mi_module`
--
ALTER TABLE `mi_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_code` (`m_code`);

--
-- Indexes for table `mi_module_assign`
--
ALTER TABLE `mi_module_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`cmp_id`);

--
-- Indexes for table `mi_party`
--
ALTER TABLE `mi_party`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_product`
--
ALTER TABLE `mi_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_purchase`
--
ALTER TABLE `mi_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_purchase_detail`
--
ALTER TABLE `mi_purchase_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_reference`
--
ALTER TABLE `mi_reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `mi_region`
--
ALTER TABLE `mi_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `region` (`region_name`);

--
-- Indexes for table `mi_reseller`
--
ALTER TABLE `mi_reseller`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `mi_role`
--
ALTER TABLE `mi_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mi_role_rights`
--
ALTER TABLE `mi_role_rights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`cmp_id`);

--
-- Indexes for table `mi_segment`
--
ALTER TABLE `mi_segment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `industry` (`industry`);

--
-- Indexes for table `mi_source`
--
ALTER TABLE `mi_source`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_state`
--
ALTER TABLE `mi_state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `country` (`country`);

--
-- Indexes for table `mi_sys_user`
--
ALTER TABLE `mi_sys_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mi_task_type`
--
ALTER TABLE `mi_task_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_transport_mode`
--
ALTER TABLE `mi_transport_mode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_unit`
--
ALTER TABLE `mi_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `mi_user`
--
ALTER TABLE `mi_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cmp_id` (`cmp_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mi_billing`
--
ALTER TABLE `mi_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_billing_detail`
--
ALTER TABLE `mi_billing_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_branch`
--
ALTER TABLE `mi_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_category`
--
ALTER TABLE `mi_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_cmp_profile`
--
ALTER TABLE `mi_cmp_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_company`
--
ALTER TABLE `mi_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_complaint_nature`
--
ALTER TABLE `mi_complaint_nature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mi_country`
--
ALTER TABLE `mi_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_department`
--
ALTER TABLE `mi_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mi_designation`
--
ALTER TABLE `mi_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mi_desig_authority`
--
ALTER TABLE `mi_desig_authority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mi_emp_juniors`
--
ALTER TABLE `mi_emp_juniors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mi_enquiry_status`
--
ALTER TABLE `mi_enquiry_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mi_expense_head`
--
ALTER TABLE `mi_expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mi_feature`
--
ALTER TABLE `mi_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mi_followup_type`
--
ALTER TABLE `mi_followup_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mi_industry`
--
ALTER TABLE `mi_industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mi_item`
--
ALTER TABLE `mi_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mi_job`
--
ALTER TABLE `mi_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_job_detail`
--
ALTER TABLE `mi_job_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_lead`
--
ALTER TABLE `mi_lead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `mi_lead_activity`
--
ALTER TABLE `mi_lead_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `mi_lead_address`
--
ALTER TABLE `mi_lead_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_lead_contacts`
--
ALTER TABLE `mi_lead_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mi_lead_products`
--
ALTER TABLE `mi_lead_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mi_lead_profile`
--
ALTER TABLE `mi_lead_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mi_location`
--
ALTER TABLE `mi_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mi_module`
--
ALTER TABLE `mi_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mi_module_assign`
--
ALTER TABLE `mi_module_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_party`
--
ALTER TABLE `mi_party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_product`
--
ALTER TABLE `mi_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mi_purchase`
--
ALTER TABLE `mi_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_purchase_detail`
--
ALTER TABLE `mi_purchase_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mi_reference`
--
ALTER TABLE `mi_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mi_region`
--
ALTER TABLE `mi_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mi_reseller`
--
ALTER TABLE `mi_reseller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mi_role`
--
ALTER TABLE `mi_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mi_role_rights`
--
ALTER TABLE `mi_role_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `mi_segment`
--
ALTER TABLE `mi_segment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mi_source`
--
ALTER TABLE `mi_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mi_state`
--
ALTER TABLE `mi_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `mi_sys_user`
--
ALTER TABLE `mi_sys_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mi_task_type`
--
ALTER TABLE `mi_task_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mi_transport_mode`
--
ALTER TABLE `mi_transport_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mi_unit`
--
ALTER TABLE `mi_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mi_user`
--
ALTER TABLE `mi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
