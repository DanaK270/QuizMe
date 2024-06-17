-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 05:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizme`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `qTakenID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `userAnswer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `qTakenID`, `questionID`, `userAnswer`) VALUES
(1, 1, 31, 'c3'),
(2, 1, 34, 'c2'),
(3, 2, 20, 'c2'),
(4, 2, 17, 'c3'),
(5, 3, 3, 'c4'),
(6, 3, 1, 'c3'),
(7, 4, 10, 'c2'),
(8, 4, 9, 'c3'),
(9, 5, 16, 'c3'),
(10, 5, 15, 'c1'),
(11, 6, 17, 'c1'),
(12, 6, 20, 'c3'),
(13, 7, 8, 'c1'),
(14, 7, 7, 'c1'),
(15, 8, 8, 'c1'),
(16, 8, 7, 'c1'),
(17, 9, 5, 'c3'),
(18, 9, 6, 'c2'),
(19, 10, 3, 'c3'),
(20, 10, 2, 'c1'),
(21, 11, 16, 'c3'),
(22, 11, 15, 'c1'),
(23, 12, 13, 'c4'),
(24, 12, 14, 'c4'),
(25, 13, 19, 'c3'),
(26, 13, 20, 'c2'),
(27, 14, 10, 'c4'),
(28, 14, 9, 'c2');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `qID` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `question` varchar(3000) NOT NULL,
  `c1` varchar(3000) NOT NULL,
  `c2` varchar(3000) NOT NULL,
  `c3` varchar(3000) NOT NULL,
  `c4` varchar(3000) NOT NULL,
  `correctC` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`qID`, `quizID`, `type`, `question`, `c1`, `c2`, `c3`, `c4`, `correctC`) VALUES
(1, 1, 'mcq', 'what is the value of X in X+9*1=0 ?', '9', '90', '-9', '8', 'c3'),
(2, 1, 'TF', '2 is divisible by 4.', 'true', 'false', '', '', 'c2'),
(3, 1, 'mcq', 'A chocolate bar costs c pence and a drink costs d pence. Write down an expression for the cost of 2 chocolate bars and 2 drinks.', 'c+d', '2c+d', '2c-2d', '2c+2d', 'c4'),
(4, 1, 'mcq', 'Simplify the expression 4m+5+2m-1.', '6m+4', '10m', '6m+6', '6m-4', 'c1'),
(5, 2, 'mcq', 'Integral of the constant function f(x) = k is:', 'kx+c', 'k', 'x', 'c', 'c1'),
(6, 2, 'mcq', 'What is the integral of the function f(x) = sin 2x', '(-1/2) cos x + C', '(-1/2) cos 2x + C', '(1/2) cos x + C', '(1/2) cos 2x + C', 'c2'),
(7, 3, 'mcq', 'What is the capital of Mexico?', 'Mexico City', 'Pueblo', 'NewYork', 'Italy', 'c1'),
(8, 3, 'mcq', 'What is the name of the tallest mountain in the world?', 'Mount Everest', 'Mount Dukhan', 'Mount Climinjaro', 'Mount Texas', 'c1'),
(9, 4, 'mcq', 'What is the term used for a block of code that is executed repeatedly until a certain condition is met?\r\n\r\n', 'Function', 'Loop', 'Condition', 'Variable', 'c2'),
(10, 4, 'mcq', 'Which data structure is used for storing a collection of elements in a non-linear fashion?', 'Array', 'Stack', 'Queue', 'Tree', 'c4'),
(11, 5, 'mcq', 'In which among the following organ, “Bowman’s Capsule” is found?', 'Liver', 'Heart', 'Kidney', 'Stomach', 'c3'),
(12, 5, 'mcq', 'The cork cells are impervious to water. Which among the following is responsible to give this quality to Cork?', 'Cellulose', 'Cutin', 'Suberin', 'Glucose', 'c3'),
(13, 5, 'mcq', 'Which among the following is not a function of Sympathetic nerves in Autonomic nervous system?', 'Enhancing the heart beats', 'constricting the blood vessels', 'dilate pupils', 'contract urinary bladder', 'c4'),
(14, 5, 'mcq', 'In the branch of biology which of the following deals with the Study of kidney?', 'Nephrology', 'Neurology', 'Neonatology', 'None of these', 'c1'),
(15, 6, 'TF', '\'bonjour\' means hello.', 'true', 'false', '', '', 'c1'),
(16, 6, 'mcq', 'What is the French for \'yes\'?', 'evet', 'non', 'oui', 'si', 'c3'),
(17, 7, 'mcq', 'Which of the following is not a correct observation as mentioned by Megasthenes about India?', 'There is abundant gold, silver, copper and iron in India', 'There is a well established caste system in India', 'There are frequent famines in India', 'Dionysus has invaded India', 'c3'),
(18, 7, 'mcq', 'During the First World War, which country signed the Peace Treaty (1917) with Germany?', 'USA', 'UK', 'Russia', 'France', 'c3'),
(19, 7, 'mcq', 'In which year, America joined the Second World War?', '1941', '1988', '1955', '1954', 'c1'),
(20, 7, 'mcq', 'Who were the Axis powers in World War-II?', 'UK Italy Japan', 'Germany USA Japan', 'Germany Italy USA', 'Germany Italy Japan', 'c4'),
(21, 8, 'mcq', '1+1 is', '1', '2', '3', '4', 'c2'),
(22, 8, 'mcq', '6*6 is', '36', '12', '66', '67', 'c1'),
(23, 8, 'mcq', ' what is the value of x in x+1=5 ', '6', '8', '4', '5', 'c3'),
(24, 8, 'TF', '2 is divisible by 4 ', 'True', 'False', '', '', 'c2'),
(25, 8, 'TF', '5+6=11', 'True', 'False', '', '', 'c1'),
(26, 8, 'TF', 'we can divide by zero', 'True', 'False', '', '', 'c2'),
(27, 8, 'TF', '7 is an odd number', 'True', 'False', '', '', 'c1'),
(28, 8, 'TF', '3 is a prime number', 'True', 'False', '', '', 'c1'),
(29, 8, 'TF', '10 is an odd number', 'True', 'False', '', '', 'c2'),
(30, 8, 'TF', 'the value of x in X+ 4=0 is 4', 'True', 'False', '', '', 'c2'),
(31, 10, 'mcq', 'What does Buenas noches mean?', 'Good Night', 'Good Morning', 'Good Afternoon', 'non of the above', 'c1'),
(32, 10, 'mcq', 'Hola means?', 'bye ', 'juice', 'Hello', 'non of the above', 'c3'),
(33, 10, 'TF', 'Gracias means Thank you?', 'True', 'False', '', '', 'c1'),
(34, 10, 'TF', 'Si means no?', 'True', 'False', '', '', 'c2'),
(35, 10, 'TF', 'Ich heise Max, is this Spanish?', 'True', 'False', '', '', 'c2'),
(36, 10, 'TF', 'Te quiero!, means I love you?', 'True', 'False', '', '', 'c1'),
(37, 10, 'TF', 'Lo Siento, means Im sorry?', 'True', 'False', '', '', 'c1'),
(38, 10, 'TF', 'Mucho gusto!, means i hate you?', 'True', 'False', '', '', 'c2'),
(39, 10, 'TF', 'Augua, means water?', 'True', 'False', '', '', 'c1'),
(40, 10, 'TF', 'Buenas tardes, means good evening?', 'True', 'False', '', '', 'c2');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `quizName` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quizID`, `userID`, `quizName`, `category`, `topic`, `level`) VALUES
(1, 2, 'Basics of Algebra', 'math', 'algebra', 'easy'),
(2, 1, 'How Well Are You in Integration?', 'math', 'calculus', 'medium'),
(3, 1, 'Around the World', 'geography', 'capitals', 'easy'),
(4, 2, 'programming 101', 'IT', 'programming', 'medium'),
(5, 5, 'Advanced Biology', 'science', 'biology', 'hard'),
(6, 6, 'French 101', 'languages', 'french', 'easy'),
(7, 3, 'History101', 'history', 'history', 'easy'),
(8, 5, 'Basic Math', 'math', 'basic math', 'easy'),
(9, 5, 'tg', 'Mathematics', 't', 'easy'),
(10, 9, 'spanish', 'languages', 'Spanish Basics', 'easy');

-- --------------------------------------------------------

--
-- Table structure for table `quizzestaken`
--

CREATE TABLE `quizzestaken` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `date` date NOT NULL,
  `duration` decimal(10,0) NOT NULL,
  `score` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzestaken`
--

INSERT INTO `quizzestaken` (`id`, `userID`, `quizID`, `date`, `duration`, `score`) VALUES
(1, 9, 10, '2023-05-27', '8', 1),
(2, 9, 7, '2023-05-27', '12', 1),
(3, 9, 1, '2023-05-27', '17', 2),
(4, 9, 4, '2023-05-27', '9', 0),
(5, 2, 6, '2023-05-27', '6', 2),
(6, 2, 7, '2023-05-27', '10', 0),
(7, 2, 3, '2023-05-27', '9', 2),
(8, 2, 3, '2023-05-27', '18', 2),
(9, 2, 2, '2023-05-27', '5', 1),
(10, 5, 1, '2023-05-27', '5', 0),
(11, 5, 6, '2023-05-27', '6', 2),
(12, 5, 5, '2023-05-27', '6', 1),
(13, 5, 7, '2023-05-27', '5', 0),
(14, 5, 4, '2023-05-27', '6', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `email`, `username`, `password`) VALUES
(1, 'dana', 'DA227@gmail.com', 'DA227', '$2y$10$7Srx0JHzhTVcyZHYTy8YFO7NiiZBlGtxAGXnJOPEncgIsd5zk3Lmi'),
(2, 'Nasser Ahmed', 'Nasser123@gmail.com', 'Nasser123', '$2y$10$PQ8iV7HGVq/2mZIjaMl0leTvIla0PCHeNubra7CR3VtliFs3DbxuS'),
(3, 'Fatema', 'fatema123@gmail.com', 'Fatema123', '$2y$10$urSjKCp1YkpgG5ExfERUguZ4KsJAa7kjW7/8nG2w/rEeBiCRnnwra'),
(4, 'Dka', 'Dka123@gmail.com', 'Dka123', '$2y$10$ysNcj8oBtIifBj9dDZquW.DekXKpwaKfPnkpUmDhlwS2zIMc6scqG'),
(5, 'Dana K', 'DanaK@gmail.com', 'DanaK', '$2y$10$rbHWSM8YcXZ4eZlzJylZIOS7BPfsc3Ta3OoYCcUBD5zE1UTlVmFSu'),
(6, 'Farha Alsada1', '202003353@stu.uob.edu.bh', 'farhalsada', '$2y$10$AyR8HyRZ6O6tepphdAQVJOEzTXSwWKcwQ7NSLUROcnID05duvALgC'),
(7, 'Faisal', 'Faisal123@gmail.com', 'Faisal123', '$2y$10$Q/m70013EGKZdzAFdhbl9O/P76r/ZQebgfYbRmBdpeizWc.fmynmi'),
(8, 'Nora', 'Nora123@gmail.com', 'Nora123', '$2y$10$bWhSn.jEuu2eWln0pSRxou3YtMPkjI/ophrYcjnIUDXiTzgftv0vK'),
(9, 'Ranaa', 'Ranaa@gmail.com', 'Rana_20', '$2y$10$KErUXB0tGbyQKwdaOSg83.CUkoYa41NAVEEc2XwjwH/7.zhF3rZ1a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign key4` (`qTakenID`),
  ADD KEY `foreign key5` (`questionID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`qID`),
  ADD KEY `foreign key5` (`quizID`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quizID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `quizzestaken`
--
ALTER TABLE `quizzestaken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `quizID` (`quizID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `qID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quizID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quizzestaken`
--
ALTER TABLE `quizzestaken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `foreign key4` FOREIGN KEY (`qTakenID`) REFERENCES `quizzestaken` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `foreign key5` FOREIGN KEY (`quizID`) REFERENCES `quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `foreign key3` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizzestaken`
--
ALTER TABLE `quizzestaken`
  ADD CONSTRAINT `foreign key1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign key2` FOREIGN KEY (`quizID`) REFERENCES `quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
