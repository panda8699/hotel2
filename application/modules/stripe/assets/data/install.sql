INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `is_active`) VALUES (8, 'Stripe', '1');
INSERT INTO `paymentsetup` (`setupid`, `paymentid`, `marchantid`, `password`, `email`, `currency`, `Islive`, `status`) VALUES (NULL, '8', 'sk_test_51K4LrSGARuj9n2Fhe4LHw506L9MM1WOU0ox1kL8TSYXZ55bLo2bHkI3xiEmh37RbXMa876F1HCAScAjzVXf6slyO00fNJCFsi3', 'pk_test_51K4LrSGARuj9n2FhnGdNrWXT29MdT1sCSqzXmpvNu2hKJuVrEcLUqw2tFu0NLGI17ZOjX7GSLDiYDdIEf1e4k9ST00L1x0Nteh', 'shakilbdtask@gmail.com', 'USD', '0', '1');
INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES ('102010305', 'Stripe', 'Online Payment', '4', '1', '1', '0', 'A', '0', '0', '0.00', '1', '2021-12-06 10:02:51', '', '0000-00-00 00:00:00');