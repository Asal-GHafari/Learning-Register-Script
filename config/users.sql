-- 
-- Table structure for table `users`
-- 
CREATE TABLE `users` (`id` INT NOT NULL AUTO_INCREMENT,
`username` varchar(25) NOT NULL ,
`password` varchar(25) NOT NULL ,
`email` varchar(35) NOT NULL ,
`active` varchar(11) ,
`avatar` text ,
`signup_date` int(10) NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT CHARSET = utf8