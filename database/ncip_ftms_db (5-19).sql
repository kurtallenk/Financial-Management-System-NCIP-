-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 08:39 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncip_ftms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `agency_id` int(11) NOT NULL,
  `agency_name` varchar(155) NOT NULL,
  `agency_budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`agency_id`, `agency_name`, `agency_budget`) VALUES
(1, 'GAS', 720000),
(2, 'STO', 420000),
(3, 'OPERATIONS', 210000);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `chart_account_id` int(11) NOT NULL,
  `chart_account_code` varchar(255) NOT NULL,
  `chart_account_title` varchar(155) NOT NULL,
  `chart_account_type` varchar(155) NOT NULL,
  `chart_account_subtype` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`chart_account_id`, `chart_account_code`, `chart_account_title`, `chart_account_type`, `chart_account_subtype`) VALUES
(1, '10101010-00', 'Cash-Collecting Officers', 'Asset', 'Cash & Cash Equivalents'),
(2, '10101020-00', 'Petty Cash', 'Asset', 'Cash & Cash Equivalents'),
(3, '10102020-24', 'Cash In Bank-LC,CA-LBP', 'Asset', 'Cash & Cash Equivalents'),
(4, '10104040-00', 'Cash-Modified Disbursement System,Regular', 'Asset', 'Cash & Cash Equivalents'),
(5, '10305010-00', 'Receivables-Disallowances/Charges', 'Asset', 'Other Receivables'),
(6, '10305020-00', 'Due from Officers and Employees', 'Asset', 'Other Receivables'),
(7, '10404010-00', 'Office Supplies Inventory', 'Asset', 'Inventories'),
(8, '10405020-00', 'Semi-expendable Office Equipment', 'Asset', 'Inventories'),
(9, '10406010-00', 'Semi-Expendable Furnitures and Fixtures Inventory', 'Asset', 'Inventories'),
(10, '10405100-00', 'Semi-Expendable Medical Equipment', 'Asset', 'Inventories'),
(11, '10601010-00', 'Land', 'Asset', 'Property, Plant & Equipments'),
(12, '10604010-00', 'Buildings', 'Asset', 'Property, Plant & Equipments'),
(13, '10604011-00', 'Accumulated Dep n-Buildings', 'Asset', 'Property, Plant & Equipments'),
(14, '10604012-00', 'Accumulated Impairment Losses-Buildings', 'Asset', 'Property, Plant & Equipments'),
(15, '10605020-00', 'Office Equipment', 'Asset', 'Property, Plant & Equipments'),
(16, '10605021-00', 'Accumulated Dep n-OE', 'Asset', 'Property, Plant & Equipments'),
(17, '10605022-00', 'Accumulated Impairment  Losses-OE', 'Asset', 'Property, Plant & Equipments'),
(18, '10605030-00', 'Information & Comm n Tech. Equipment', 'Asset', 'Property, Plant & Equipments'),
(19, '10605031-00', 'Accumulated Dep n ICTE', 'Asset', 'Property, Plant & Equipments'),
(20, '10605032-00', 'Accumulated Impairment Losses-ICTE', 'Asset', 'Property, Plant & Equipments'),
(21, '10605110-00', 'Medical Equipment', 'Asset', 'Property, Plant & Equipments'),
(22, '10605111-00', 'Accumulated Dep n-ME', 'Asset', 'Property, Plant & Equipments'),
(23, '10605112-00', 'Accumulated Impairment Losses-ME', 'Asset', 'Property, Plant & Equipments'),
(24, '10605120-00', 'Printing Equipment', 'Asset', 'Property, Plant & Equipments'),
(25, '10605121-00', 'Accumulated Impairment Losses-PE', 'Asset', 'Property, Plant & Equipments'),
(26, '10605140-00', 'Technical & Scientific Equipment', 'Asset', 'Property, Plant & Equipments'),
(27, '10605141-00', 'Accumulated Dep n-TSE', 'Asset', 'Property, Plant & Equipments'),
(28, '10605142-00', 'Accumulated Impairment Losses-TSE', 'Asset', 'Property, Plant & Equipments'),
(29, '10606010-00', 'Motor Vehicles', 'Asset', 'Property, Plant & Equipments'),
(30, '10606011-00', 'Accumulated Dep n-MV', 'Asset', 'Property, Plant & Equipments'),
(31, '10606012-00', 'Accumulated Impairment Losses-MV', 'Asset', 'Property, Plant & Equipments'),
(32, '10607010-00', 'Furnitures and Fixtures', 'Asset', 'Property, Plant & Equipments'),
(33, '10607011-00', 'Accumulated Dep n-F&F', 'Asset', 'Property, Plant & Equipments'),
(34, '10607012-00', 'Accumulated Impairment Losses-F&F', 'Asset', 'Property, Plant & Equipments'),
(35, '10607020-00', 'Books', 'Asset', 'Property, Plant & Equipments'),
(36, '10607021-00', 'Accumulated Dep n-Books', 'Asset', 'Property, Plant & Equipments'),
(37, '10607022-00', 'Accumulated Impairment Losses-Books', 'Asset', 'Property, Plant & Equipments'),
(38, '10801020-00', 'Computer Software', 'Asset', 'Intangible Assets'),
(39, '10801021-00', 'Accumulated Dep n-CS', 'Asset', 'Intangible Assets'),
(40, '19901030-00', 'Advances to Special Disbursing Officers', 'Asset', 'Other Assets'),
(41, '19901040-00', 'Advances to Officers & Employees', 'Asset', 'Other Assets'),
(42, '19902020-00', 'Prepaid Rent', 'Asset', 'Other Assets'),
(43, '19902050-00', 'Prepaid Insurance', 'Asset', 'Other Assets'),
(44, '19999990-00', 'Other Assets', 'Asset', 'Other Assets'),
(45, '19999991-00', 'Accumulated Dep n-Other Assets', 'Asset', 'Other Assets'),
(46, '20101010-00', 'Accounts Payable', 'Liabilities', ''),
(47, '20101020-00', 'Due to Officers & Employees', 'Liabilities', ''),
(48, '20201010-00', 'Due to BIR', 'Liabilities', ''),
(49, '20201010-01', 'Due to BIR - CWT', 'Liabilities', ''),
(50, '20201010-02', 'Due to BIR - VAT (5%)', 'Liabilities', ''),
(51, '20201010-03', 'Due to BIR - PT (3%)', 'Liabilities', ''),
(52, '20201010-04', 'Due to BIR - EWT on Goods (1%)', 'Liabilities', ''),
(53, '20201010-05', 'Due to BIR - EWT on Services (2%)', 'Liabilities', ''),
(54, '20201010-06', 'Due to BIR - EWT (10,15%)', 'Liabilities', ''),
(55, '20201010-07', 'Due to BIR - EWT on Rentals (5%)', 'Liabilities', ''),
(56, '1601C', 'Tax on Compensation', 'Liabilities', ''),
(57, 'WB080', 'Person Exempt from VAT', 'Liabilities', ''),
(58, 'WV020', 'VAT Registered (Suppliers of Services)', 'Liabilities', ''),
(59, 'WV010', 'VAT Registered (Suppliers of Goods)', 'Liabilities', ''),
(60, 'WI100', 'Rent of Properties (Indiv)', 'Liabilities', ''),
(61, 'WC100', 'Rent of Properties (Corp)', 'Liabilities', ''),
(62, 'WI050', 'Professional Services', 'Liabilities', ''),
(63, 'WI157', 'Income Payments from Supplier of Services (Indiv)', 'Liabilities', ''),
(64, 'WC157', 'Income Payments from Supplier of Services (Corp)', 'Liabilities', ''),
(65, 'WI158', 'Income Payments from Supplier of Goods (Indiv)', 'Liabilities', ''),
(66, 'WC158', 'Income Payments from Supplier of Goods (Corp)', 'Liabilities', ''),
(67, '20201020-00', 'Due to GSIS', 'Liabilities', ''),
(68, '20201020-01', '          Life & Retirement Premium', 'Liabilities', ''),
(69, '20201020-02', '          ECC', 'Liabilities', ''),
(70, '20201020-03', '          Salary Loan', 'Liabilities', ''),
(71, '20201020-04', '          Policy Loan', 'Liabilities', ''),
(72, 'ps', 'Personnel Share', 'Liabilities', ''),
(73, 'conso', 'Consolidated Loan', 'Liabilities', ''),
(74, 'policy', 'Policy Loan', 'Liabilities', ''),
(75, 'uoli', 'Unlimited Optional Life Insurance', 'Liabilities', ''),
(76, 'emergency', 'EMERGENCY Loan', 'Liabilities', ''),
(77, 'educational', 'EDUCATIONAL Loan', 'Liabilities', ''),
(78, '20201030-00', 'Due to PAG-IBIG', 'Liabilities', ''),
(79, '20201030-01', '          Contribution Premium', 'Liabilities', ''),
(80, '20201030-02', '          Multi-purpose Loan', 'Liabilities', ''),
(81, '20201030-03', '          Housing Loan', 'Liabilities', ''),
(82, '20201040-00', 'Due to Philheath', 'Liabilities', ''),
(83, '20201050-00', 'Due to NGAs', 'Liabilities', ''),
(84, '20201070-00', 'Due to LGU', 'Liabilities', ''),
(85, '29999990-00', 'Other Payables-LBP', 'Liabilities', ''),
(86, '29999990-01', '         Contribution-NCIPEA ', 'Liabilities', ''),
(87, '29999990-02', '         Mandatory -NCIPEA ', 'Liabilities', ''),
(88, '29999990-03', '         Loan - NCIPEA ', 'Liabilities', ''),
(89, '29999990-04', '         Salary Loan - lbp', 'Liabilities', ''),
(90, '29999990-05', '        Others', 'Liabilities', ''),
(91, '30101010-00', 'Accumulated Surplus/Deficit', 'Equity', ''),
(92, '30301010-00', 'Revenue & Summary', 'Equity', ''),
(93, '40201990-99', 'Other Service Income', 'Equity', 'Income'),
(94, '40202990-99', 'Other Business Income', 'Equity', 'Income'),
(95, '50101010-01', 'Salaries & Wages-Regular', 'Expenses', 'Personnel Services'),
(96, '50101010-02', 'Basic Pay-Military/Uniformed Personnel', 'Expenses', 'Personnel Services'),
(97, '50101020-00', 'Salaries & Wages-Contractual', 'Expenses', 'Personnel Services'),
(98, '50102010-01', 'PERA', 'Expenses', 'Other Compensation'),
(99, '50102010-02', 'PERA-Military/Uniformed Personnel', 'Expenses', 'Other Compensation'),
(100, '50102020-00', 'RA', 'Expenses', 'Other Compensation'),
(101, '50102030-00', 'TA', 'Expenses', 'Other Compensation'),
(102, '50102030-02', 'RATA Of Sectorial/Alternate Sectorial Representative', 'Expenses', 'Other Compensation'),
(103, '50102040-01', 'Clothing/Uniform Allowance -Civilian', 'Expenses', 'Clothing/Uniform Allowance'),
(104, '50102050-01', 'Subsistence Allowance-Military/Uniformed Personnel', 'Expenses', 'Subsistence Allowance'),
(105, '50102060-01', 'Laundry Allowance-Civilian', 'Expenses', 'Laundry Allowance'),
(106, '50102080-01', 'Productivity Incentive Allowance-Civilian', 'Expenses', 'Productivity Incentive Allowance'),
(107, '50102100-01', 'Honoraria-Civilian', 'Expenses', 'Honoraria'),
(108, '50102100-02', 'Honoraria-Military/Uniformed', 'Expenses', 'Honoraria'),
(109, '50102120-01', 'Longevity Pay-Civilian', 'Expenses', 'Longevity Pay'),
(110, '50102140-01', 'Year End Bonus-Civilian', 'Expenses', 'Year End Bonus'),
(111, '50102150-01', 'Cash Gift-Civilian', 'Expenses', 'Cash Gift'),
(112, '50102990-11', 'Collective Negotiation Agreement Incentive-Civilian', 'Expenses', 'Other Bonuses And Allowances'),
(113, '50102990-14', 'Performance Based Bonus-Civilian', 'Expenses', 'Other Bonuses And Allowances'),
(114, '50103010-00', 'RLIP', 'Expenses', 'Personnel Benefit Contribution'),
(115, '50103020-01', 'Pag-ibig Contribution Civilian', 'Expenses', 'Pag-ibig Contribution'),
(116, '50103030-01', 'Philhealth Contribution-Civilian', 'Expenses', 'Philhealth Contribution'),
(117, '50103040-01', 'ECC Contribution - Civilian', 'Expenses', 'Employees Compensation Insurance Premiums'),
(118, '50104020-01', 'Retirement Gratuity-Civilian', 'Expenses', 'Retirement Gratuity'),
(119, '50104030-01', 'Terminal Leave Benefits-Civilian', 'Expenses', 'Terminal Leave Benefits'),
(120, '50201010-00', 'Travelling Expenses-Local', 'Expenses', 'Travelling Expenses'),
(121, '50201020-00', 'Travelling Expenses-Foreign', 'Expenses', 'Travelling Expenses'),
(122, '50202010-00', 'Training Expenses', 'Expenses', 'Training & Scholarship Expenses'),
(123, '50202020-00', 'Scholarship Grants/Expenses', 'Expenses', 'Training & Scholarship Expenses'),
(124, '50203010-00', 'Office Supplies Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(125, '50203020-00', 'Accountable Form Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(126, '50203030-00', 'Non-Accountable Form Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(127, '50203040-00', 'Animal/Zoological Supplies Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(128, '50203050-00', 'Food Supplies Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(129, '50203060-00', 'Welfare Goods Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(130, '50203070-00', 'Drugs and Medicine Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(131, '50203080-00', 'Medical, Dental & Laboratory Supplies Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(132, '50203090-00', 'Fuel, Oil & Lubricants Expense', 'Expenses', 'Supplies and Materials Expenses'),
(133, '50203100-00', 'Agricultural and Marine Supplies Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(134, '50203110-01', 'Textbooks and Instructional Manual Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(135, '50203110-02', 'Chalk Allowance', 'Expenses', 'Supplies and Materials Expenses'),
(136, '50203120-00', 'Military,Police and Traffic Supplies Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(137, '50203130-00', 'Chemical and Filtering Supplies Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(138, '50203210-00', 'Semi-Expendable-Office Equipment Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(139, '50203220-00', 'Semi-Expendable-furnitures, Fixtures & Book Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(140, '50203990-00', 'Other Supplies and Materials Expenses', 'Expenses', 'Supplies and Materials Expenses'),
(141, '50204010-00', 'Water Expenses', 'Expenses', 'Utility Expenses'),
(142, '50204020-00', 'Electricity Expenses', 'Expenses', 'Utility Expenses'),
(143, '50205010-00', 'Postage and Courier Services', 'Expenses', 'Communication Expenses'),
(144, '50205020-01', 'Telephone Expenses-Mobile', 'Expenses', 'Telephone Expenses'),
(145, '50205020-02', 'Telephone Expenses -Landline', 'Expenses', 'Telephone Expenses'),
(146, '50205030-00', 'Internet Subscription Expenses', 'Expenses', 'Telephone Expenses'),
(147, '50205040-00', 'Cable,Satellite, Telegraph and Radio Expenses', 'Expenses', 'Telephone Expenses'),
(148, '50207010-00', 'Survey Expenses', 'Expenses', 'Survey, Research, Exploration and Development Services'),
(149, '50210030-00', 'Extraordinary and Miscellaneous Expenses', 'Expenses', 'Confidential, Intelligence and Extraordinary Expenses'),
(150, '50211010-00', 'Legal Services', 'Expenses', 'Professional Services'),
(151, '50211020-00', 'Auditing Services', 'Expenses', 'Professional Services'),
(152, '50211030-00', 'Consultancy Services', 'Expenses', 'Professional Services'),
(153, '50211990-00', 'Other Professional Services', 'Expenses', 'Professional Services'),
(154, '50213050-02', 'Repair & Maintenance-Office Equipment', 'Expenses', 'Repair & Maintenance-'),
(155, '50213050-03', 'Repair & Maintenance-ICT Equipment', 'Expenses', 'Repair & Maintenance-'),
(156, '50213060-01', 'Repair & Maintenance-Motor Vehicle', 'Expenses', 'Repair & Maintenance-'),
(157, '50213070-00', 'Repair & Maintenance-Furniture & Fixture', 'Expenses', 'Repair & Maintenance-'),
(158, '50214010-00', 'Subsidy to NGAs', 'Expenses', 'Financial Assistance/Sudsidy'),
(159, '50214020-00', 'Financial Assistance to NGAs', 'Expenses', 'Financial Assistance/Sudsidy'),
(160, '50214990-00', 'Sudsidies-Others', 'Expenses', 'Financial Assistance/Sudsidy'),
(161, '50215020-00', 'Fidelity Bond Premiums', 'Expenses', 'Fidelity Bond Premiums'),
(162, '50215030-00', 'Insurance Expense', 'Expenses', 'Insurance Expense'),
(163, '', 'Labor & Wages', 'Expenses', 'Other Maintenace and Operating Expenses'),
(164, '50299010-00', 'Advertising Expenses', 'Expenses', 'Other Maintenace and Operating Expenses'),
(165, '50299020-00', 'Printing and Publication Expenses', 'Expenses', 'Other Maintenace and Operating Expenses'),
(166, '50299030-00', 'Representation Expenses', 'Expenses', 'Other Maintenace and Operating Expenses'),
(167, '50299040-00', 'Transportation and Delivery Expenses', 'Expenses', 'Other Maintenace and Operating Expenses'),
(168, '50299050-00', 'Rent/Lease Expenses', 'Expenses', 'Rent/Lease Expenses'),
(169, '50299050-01', 'Rent-Buildings and Structure', 'Expenses', 'Rent/Lease Expenses'),
(170, '50299050-02', 'Rent-Land', 'Expenses', 'Rent/Lease Expenses'),
(171, '50299050-03', 'Rent-Motor Vehicle', 'Expenses', 'Rent/Lease Expenses'),
(172, '50299050-04', 'Rent-Equipment', 'Expenses', 'Rent/Lease Expenses'),
(173, '50299060-00', 'Membership Dues and Contributions to Organizations', 'Expenses', 'Rent/Lease Expenses'),
(174, '50299070-00', 'Subscription Expenses', 'Expenses', 'Rent/Lease Expenses'),
(175, '50299080-00', 'Donations', 'Expenses', 'Rent/Lease Expenses'),
(176, '50299990-00', 'Other MOOE', 'Expenses', 'Other Maintenace and Operating Expenses'),
(177, '50299990-01', 'Website Maintenance', 'Expenses', 'Other Maintenace and Operating Expenses'),
(178, '50299990-99', 'Other Maintenace and Operating Expenses', 'Expenses', 'Other Maintenace and Operating Expenses'),
(179, '50301040-00', 'Bank Charges', 'Expenses', 'FINANCIAL EXPENSES'),
(180, '50604050-01', 'Machinery', 'Expenses', 'Machinery and Equipment Outlay'),
(181, '50604050-02', 'Office Equipment', 'Expenses', 'Machinery and Equipment Outlay'),
(182, '50604050-03', 'ICT Equipment', 'Expenses', 'Machinery and Equipment Outlay'),
(183, '50501040-01', 'Dep n-Buildings', 'Expenses', 'NON-CASH EXPENSES'),
(184, '50501050-01', 'Dep n-Machinery', 'Expenses', 'NON-CASH EXPENSES'),
(185, '50501050-02', 'Dep n-Office Equipment', 'Expenses', 'NON-CASH EXPENSES'),
(186, '50501050-03', 'Dep n- ICT Equipment', 'Expenses', 'NON-CASH EXPENSES'),
(187, '50501050-11', 'Dep n- Medical Equipment', 'Expenses', 'NON-CASH EXPENSES'),
(188, '50501050-12', 'Dep n-Printing Equipment', 'Expenses', 'NON-CASH EXPENSES'),
(189, '50501050-14', 'Dep n- TS Equipment', 'Expenses', 'NON-CASH EXPENSES'),
(190, '50501060-01', 'Dep n- Motor Vehicle', 'Expenses', 'NON-CASH EXPENSES'),
(191, '50501070-01', 'Dep n Furniture & Fixture', 'Expenses', 'NON-CASH EXPENSES'),
(192, '50501070-02', 'Books', 'Expenses', 'NON-CASH EXPENSES'),
(193, '50502010-02', 'Amort n-Computer Software', 'Expenses', 'Amortization-Intangibles');

-- --------------------------------------------------------

--
-- Table structure for table `list_of_sub_allotments`
--

CREATE TABLE `list_of_sub_allotments` (
  `sub_allot_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `sub_program_id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL,
  `uacs_id` int(11) NOT NULL,
  `responsibility_center` varchar(155) NOT NULL,
  `class_category` varchar(155) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `program_name` varchar(155) NOT NULL,
  `program_budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `agency_id`, `program_name`, `program_budget`) VALUES
(1, 1, 'General Administration and Support', 0),
(2, 1, 'Administration of Personnel Benefits', 0),
(3, 2, 'Policy Formulation, Planning and Coordination of Programs and Projects', 0),
(4, 3, 'Ancestral Domain / Land Security and Development Program', 0),
(5, 3, 'Human, Socio-economic and Ecology Development and Protection Program', 0),
(6, 3, 'Indigenous Peoples Rights of Protection Program', 0);

-- --------------------------------------------------------

--
-- Table structure for table `specific_budget`
--

CREATE TABLE `specific_budget` (
  `specific_budget_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL,
  `uacs_id` int(11) NOT NULL,
  `responsibility_center` varchar(155) NOT NULL,
  `gaasaa` varchar(155) NOT NULL,
  `class_category` varchar(155) NOT NULL,
  `specific_budget_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specific_budget`
--

INSERT INTO `specific_budget` (`specific_budget_id`, `program_id`, `agency_id`, `project`, `uacs_id`, `responsibility_center`, `gaasaa`, `class_category`, `specific_budget_amount`) VALUES
(74, 1, 1, 'Test GAs', 1, 'Baguio', 'GAA', 'MOOE', 50000),
(80, 4, 3, 'test0506_eee', 2, 'Regional Office', 'GAA', 'MOOE', 100000),
(82, 4, 3, 'TEST_AGAIN_OPERATIONS', 1, 'Regional Office', 'GAA', 'MOOE', 50000),
(83, 1, 1, 'Test Project', 2, 'Regional Office', 'GAA', 'MOOE', 50000),
(92, 3, 2, 'TEST STO 52 e', 1, 'Regional Office', 'GAA', 'MOOE', 30000),
(99, 3, 2, 'TEST_AGAIN_STO', 2, 'Regional Office', 'GAA', 'MOOE', 50000),
(100, 3, 2, 'TEST_AGAIN', 1, 'Regional Office', 'GAA', 'MOOE', 60000),
(101, 6, 3, 'TEST_OP_Indigenous', 12, 'Regional Office', 'GAA', 'MOOE', 50000),
(102, 5, 3, 'TEST_HUMAN_e', 2, 'Regional Office', 'GAA', 'MOOE', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `sub_program`
--

CREATE TABLE `sub_program` (
  `sub_program_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `sub_program_name` varchar(155) NOT NULL,
  `sub_program_budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_program`
--

INSERT INTO `sub_program` (`sub_program_id`, `agency_id`, `program_id`, `sub_program_name`, `sub_program_budget`) VALUES
(1, 3, 4, 'Ancestral Domain / Land Recognition', 0),
(2, 3, 4, 'Assistance of Ancestral Domain Sustainable Development and Protection Plan (ADSDPP) Formulation', 0),
(3, 3, 5, 'Culturally Appropriate / Responsive and Gender Sensitive Socio-economic and Ecology Development and Protection Services', 0),
(4, 3, 5, 'IP Education and Advocacy Services', 0),
(5, 3, 5, 'IP Culture Services', 0),
(6, 3, 5, 'IP Health Services', 0),
(7, 3, 6, 'Gender and Rights-based Services', 0),
(8, 3, 6, 'IP Rights Advocacy and Monitoring of Treaty Obligations', 0),
(9, 3, 6, 'Legal Services', 0),
(10, 3, 6, 'Adjudication Services', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_program_budget`
--

CREATE TABLE `sub_program_budget` (
  `sub_program_budget_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `sub_program_id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL,
  `uacs_id` int(11) NOT NULL,
  `responsibility_center` varchar(155) NOT NULL,
  `gaasaa` varchar(155) NOT NULL,
  `class_category` varchar(155) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_program_budget`
--

INSERT INTO `sub_program_budget` (`sub_program_budget_id`, `agency_id`, `program_id`, `sub_program_id`, `project`, `uacs_id`, `responsibility_center`, `gaasaa`, `class_category`, `budget`) VALUES
(5, 3, 4, 1, 'test', 1, 'Regional Office', 'GAA', 'MOOE', 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agency_id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`chart_account_id`);

--
-- Indexes for table `list_of_sub_allotments`
--
ALTER TABLE `list_of_sub_allotments`
  ADD PRIMARY KEY (`sub_allot_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `sub_program_id` (`sub_program_id`),
  ADD KEY `uacs_id` (`uacs_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `specific_budget`
--
ALTER TABLE `specific_budget`
  ADD PRIMARY KEY (`specific_budget_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `uacs_id` (`uacs_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `sub_program`
--
ALTER TABLE `sub_program`
  ADD PRIMARY KEY (`sub_program_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `sub_program_budget`
--
ALTER TABLE `sub_program_budget`
  ADD PRIMARY KEY (`sub_program_budget_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `sub_program_id` (`sub_program_id`),
  ADD KEY `uacs_id` (`uacs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `chart_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `list_of_sub_allotments`
--
ALTER TABLE `list_of_sub_allotments`
  MODIFY `sub_allot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specific_budget`
--
ALTER TABLE `specific_budget`
  MODIFY `specific_budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `sub_program`
--
ALTER TABLE `sub_program`
  MODIFY `sub_program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sub_program_budget`
--
ALTER TABLE `sub_program_budget`
  MODIFY `sub_program_budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_of_sub_allotments`
--
ALTER TABLE `list_of_sub_allotments`
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`),
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`),
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_3` FOREIGN KEY (`sub_program_id`) REFERENCES `sub_program` (`sub_program_id`),
  ADD CONSTRAINT `list_of_sub_allotments_ibfk_4` FOREIGN KEY (`uacs_id`) REFERENCES `chart_of_accounts` (`chart_account_id`);

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`);

--
-- Constraints for table `specific_budget`
--
ALTER TABLE `specific_budget`
  ADD CONSTRAINT `specific_budget_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`),
  ADD CONSTRAINT `specific_budget_ibfk_2` FOREIGN KEY (`uacs_id`) REFERENCES `chart_of_accounts` (`chart_account_id`),
  ADD CONSTRAINT `specific_budget_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`);

--
-- Constraints for table `sub_program`
--
ALTER TABLE `sub_program`
  ADD CONSTRAINT `sub_program_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`),
  ADD CONSTRAINT `sub_program_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`);

--
-- Constraints for table `sub_program_budget`
--
ALTER TABLE `sub_program_budget`
  ADD CONSTRAINT `sub_program_budget_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`),
  ADD CONSTRAINT `sub_program_budget_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `program` (`program_id`),
  ADD CONSTRAINT `sub_program_budget_ibfk_3` FOREIGN KEY (`sub_program_id`) REFERENCES `sub_program` (`sub_program_id`),
  ADD CONSTRAINT `sub_program_budget_ibfk_4` FOREIGN KEY (`uacs_id`) REFERENCES `chart_of_accounts` (`chart_account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
