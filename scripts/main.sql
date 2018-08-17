-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 25, 2018 at 02:32 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `individual_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `CJ_actions`
--

CREATE TABLE `CJ_actions` (
  `actionID` int(11) NOT NULL,
  `actionDesc` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_challenges`
--

CREATE TABLE `CJ_challenges` (
  `challengeID` int(11) NOT NULL,
  `challengeDesc` varchar(500) NOT NULL,
  `personaID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_feelings`
--

CREATE TABLE `CJ_feelings` (
  `feelingID` int(11) NOT NULL,
  `feelingDesc` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_feelings`
--

INSERT INTO `CJ_feelings` (`feelingID`, `feelingDesc`, `userJourneyID`) VALUES
(124, 'Confused', 68),
(125, 'Unsure', 68),
(126, 'Hopeful', 68),
(127, 'Happy', 68);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_frustrations`
--

CREATE TABLE `CJ_frustrations` (
  `frustrationID` int(11) NOT NULL,
  `frustrationDesc` varchar(500) NOT NULL,
  `personaID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_goals`
--

CREATE TABLE `CJ_goals` (
  `goalID` int(11) NOT NULL,
  `goalDesc` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_goals`
--

INSERT INTO `CJ_goals` (`goalID`, `goalDesc`, `userJourneyID`) VALUES
(103, 'Research flight options', 68),
(104, 'Book flight tickets', 68),
(105, 'Pack everything which is needed for the travel', 68),
(106, 'Go to the airport and fly to destination', 68);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_goals_persona`
--

CREATE TABLE `CJ_goals_persona` (
  `goalID` int(11) NOT NULL,
  `goalDesc` varchar(500) NOT NULL,
  `personaID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_images`
--

CREATE TABLE `CJ_images` (
  `imageID` int(11) NOT NULL,
  `imageName` varchar(500) NOT NULL,
  `imageUrl` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_motavations`
--

CREATE TABLE `CJ_motavations` (
  `motavationID` int(11) NOT NULL,
  `motavationDesc` varchar(500) NOT NULL,
  `personaID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_needs`
--

CREATE TABLE `CJ_needs` (
  `needID` int(11) NOT NULL,
  `needDesc` varchar(500) NOT NULL,
  `personaID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_opportunities`
--

CREATE TABLE `CJ_opportunities` (
  `opportunityID` int(11) NOT NULL,
  `opportunityDesc` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_opportunities`
--

INSERT INTO `CJ_opportunities` (`opportunityID`, `opportunityDesc`, `userJourneyID`) VALUES
(112, 'Continue to offer competitive prices', 68),
(113, 'Continue to re-think about the design of the website', 68),
(114, 'Promote the mobile application alot more', 68),
(115, 'Streamline the boarding process', 68);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_pain_points`
--

CREATE TABLE `CJ_pain_points` (
  `painPointID` int(11) NOT NULL,
  `painPointDesc` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_personas`
--

CREATE TABLE `CJ_personas` (
  `personaID` int(11) NOT NULL,
  `personaName` varchar(200) NOT NULL,
  `occupation` varchar(200) NOT NULL,
  `age` int(2) NOT NULL,
  `children` int(2) NOT NULL,
  `martitalStatus` varchar(100) NOT NULL,
  `quote` varchar(500) NOT NULL,
  `digitalInclusionScale` int(2) NOT NULL,
  `personalProfile` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT 'default-profile.png',
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_personas`
--

INSERT INTO `CJ_personas` (`personaID`, `personaName`, `occupation`, `age`, `children`, `martitalStatus`, `quote`, `digitalInclusionScale`, `personalProfile`, `image`, `projectID`) VALUES
(23, 'Joe Bloggs', 'Website designer', 43, 2, 'Married', 'So frustrating building user journey maps from scratch', 7, 'Joe works for a digital agency for 10 years now as a website designer. He finds some of the website design process slightly annoying.', 'helmet_goggles-512.png', 24),
(27, 'John Bloggs ', 'IT Consultant', 34, 2, 'Married', 'I like software which is simple and easy to use', 8, 'Joe works for a digital agency for 10 years now as a website designer. He finds some of the website design process slightly annoying.', 'default-profile.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_projects`
--

CREATE TABLE `CJ_projects` (
  `projectID` int(11) NOT NULL,
  `projectName` varchar(225) NOT NULL,
  `projectDesc` varchar(400) NOT NULL,
  `ownerID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_projects`
--

INSERT INTO `CJ_projects` (`projectID`, `projectName`, `projectDesc`, `ownerID`) VALUES
(1, 'Self Assessment ', '   Self assessment tax return register form redesign      ', 1),
(24, 'anthonys', 'test anthony ', 1),
(25, 'Test', 'test ', 14);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_project_shared_users`
--

CREATE TABLE `CJ_project_shared_users` (
  `projectUserID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `projectID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_project_shared_users`
--

INSERT INTO `CJ_project_shared_users` (`projectUserID`, `userID`, `projectID`) VALUES
(2, 13, 1),
(3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_stages`
--

CREATE TABLE `CJ_stages` (
  `stageID` int(11) NOT NULL,
  `stageDesc` varchar(225) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_stages`
--

INSERT INTO `CJ_stages` (`stageID`, `stageDesc`, `userJourneyID`) VALUES
(211, 'Research travel', 68),
(212, 'Book flight', 68),
(213, 'Pre-travel', 68),
(214, 'Travel:boarding', 68);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_technologies`
--

CREATE TABLE `CJ_technologies` (
  `technologyID` int(11) NOT NULL,
  `technologyDesc` varchar(500) NOT NULL,
  `personaID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CJ_thinking`
--

CREATE TABLE `CJ_thinking` (
  `thinkingID` int(11) NOT NULL,
  `thinkingDesc` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_thinking`
--

INSERT INTO `CJ_thinking` (`thinkingID`, `thinkingDesc`, `userJourneyID`) VALUES
(109, 'I hope I can find a convenient flight at a good price', 68),
(110, 'The website is content heavy, not sure what I need to do next', 68),
(111, 'I could download the airlines application', 68),
(112, 'Finally on my way', 68);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_users`
--

CREATE TABLE `CJ_users` (
  `userID` int(11) NOT NULL,
  `forename` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `emailAddress` varchar(225) NOT NULL,
  `password` varchar(100) NOT NULL,
  `forgotPasswordToken` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_users`
--

INSERT INTO `CJ_users` (`userID`, `forename`, `surname`, `emailAddress`, `password`, `forgotPasswordToken`) VALUES
(1, 'Anthony', 'Wilkinson', 'antwilk21@sky.com', '$2y$10$.Ugz9b3HXAoNYoIkQ8Mu8u0JBbSXQSjU5DRe8UOHRFhrsghWr1Tke', ''),
(6, 'Anthony', 'Wilkinson', 'anthony.wilkinson213@gmail.com', '$2y$10$.pXS7VeomfHPRHBFHs5SzuvsO/FmWPcZ5D18RnO/MsUMi6Sf9Ct6C', ''),
(13, 'Anthony', 'Wilkinson', 'anthony2.wilkinson@northumbria.ac.uk', '$2y$10$YuZqQNa3zT00vR2cUIbyLeGJxzuL3onHTEzcMDKBr2NpdlUi.yYjO', ''),
(14, 'Anthony', 'Wilkinson', 'ant.wilkinson6@gmail.com', '$2y$10$KVXQHPMpcHdFbxLEK.WVku8iYb9DKZR3JImoq7HwipKCYsSoKPcku', '');

-- --------------------------------------------------------

--
-- Table structure for table `CJ_user_journeys`
--

CREATE TABLE `CJ_user_journeys` (
  `userJourneyID` int(11) NOT NULL,
  `nameOfJourney` varchar(225) NOT NULL,
  `projectID` int(11) NOT NULL,
  `personaID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CJ_user_journeys`
--

INSERT INTO `CJ_user_journeys` (`userJourneyID`, `nameOfJourney`, `projectID`, `personaID`) VALUES
(68, 'afsd', 1, 27);

-- --------------------------------------------------------

--
-- Table structure for table `CJ_user_needs`
--

CREATE TABLE `CJ_user_needs` (
  `userNeedID` int(11) NOT NULL,
  `userNeedDesc` varchar(500) NOT NULL,
  `userJourneyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CJ_actions`
--
ALTER TABLE `CJ_actions`
  ADD PRIMARY KEY (`actionID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- Indexes for table `CJ_challenges`
--
ALTER TABLE `CJ_challenges`
  ADD PRIMARY KEY (`challengeID`),
  ADD KEY `personaID` (`personaID`);

--
-- Indexes for table `CJ_feelings`
--
ALTER TABLE `CJ_feelings`
  ADD PRIMARY KEY (`feelingID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- Indexes for table `CJ_frustrations`
--
ALTER TABLE `CJ_frustrations`
  ADD PRIMARY KEY (`frustrationID`),
  ADD KEY `personaID` (`personaID`);

--
-- Indexes for table `CJ_goals`
--
ALTER TABLE `CJ_goals`
  ADD PRIMARY KEY (`goalID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- Indexes for table `CJ_goals_persona`
--
ALTER TABLE `CJ_goals_persona`
  ADD PRIMARY KEY (`goalID`),
  ADD KEY `personaID` (`personaID`);

--
-- Indexes for table `CJ_images`
--
ALTER TABLE `CJ_images`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- Indexes for table `CJ_motavations`
--
ALTER TABLE `CJ_motavations`
  ADD PRIMARY KEY (`motavationID`),
  ADD KEY `personaID` (`personaID`);

--
-- Indexes for table `CJ_needs`
--
ALTER TABLE `CJ_needs`
  ADD PRIMARY KEY (`needID`),
  ADD KEY `personaID` (`personaID`);

--
-- Indexes for table `CJ_opportunities`
--
ALTER TABLE `CJ_opportunities`
  ADD PRIMARY KEY (`opportunityID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- Indexes for table `CJ_pain_points`
--
ALTER TABLE `CJ_pain_points`
  ADD PRIMARY KEY (`painPointID`),
  ADD KEY `userJourneyID` (`userJourneyID`),
  ADD KEY `userJourneyID_2` (`userJourneyID`);

--
-- Indexes for table `CJ_personas`
--
ALTER TABLE `CJ_personas`
  ADD PRIMARY KEY (`personaID`),
  ADD KEY `projectID` (`projectID`);

--
-- Indexes for table `CJ_projects`
--
ALTER TABLE `CJ_projects`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `ownerID` (`ownerID`),
  ADD KEY `ownerID_2` (`ownerID`);

--
-- Indexes for table `CJ_project_shared_users`
--
ALTER TABLE `CJ_project_shared_users`
  ADD PRIMARY KEY (`projectUserID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `projectID` (`projectID`);

--
-- Indexes for table `CJ_stages`
--
ALTER TABLE `CJ_stages`
  ADD PRIMARY KEY (`stageID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- Indexes for table `CJ_technologies`
--
ALTER TABLE `CJ_technologies`
  ADD PRIMARY KEY (`technologyID`),
  ADD KEY `personaID` (`personaID`);

--
-- Indexes for table `CJ_thinking`
--
ALTER TABLE `CJ_thinking`
  ADD PRIMARY KEY (`thinkingID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- Indexes for table `CJ_users`
--
ALTER TABLE `CJ_users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `CJ_user_journeys`
--
ALTER TABLE `CJ_user_journeys`
  ADD PRIMARY KEY (`userJourneyID`),
  ADD KEY `projectID` (`projectID`),
  ADD KEY `personaID` (`personaID`);

--
-- Indexes for table `CJ_user_needs`
--
ALTER TABLE `CJ_user_needs`
  ADD PRIMARY KEY (`userNeedID`),
  ADD KEY `userJourneyID` (`userJourneyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CJ_actions`
--
ALTER TABLE `CJ_actions`
  MODIFY `actionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `CJ_challenges`
--
ALTER TABLE `CJ_challenges`
  MODIFY `challengeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `CJ_feelings`
--
ALTER TABLE `CJ_feelings`
  MODIFY `feelingID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `CJ_frustrations`
--
ALTER TABLE `CJ_frustrations`
  MODIFY `frustrationID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `CJ_goals`
--
ALTER TABLE `CJ_goals`
  MODIFY `goalID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `CJ_goals_persona`
--
ALTER TABLE `CJ_goals_persona`
  MODIFY `goalID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `CJ_images`
--
ALTER TABLE `CJ_images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `CJ_motavations`
--
ALTER TABLE `CJ_motavations`
  MODIFY `motavationID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `CJ_needs`
--
ALTER TABLE `CJ_needs`
  MODIFY `needID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `CJ_opportunities`
--
ALTER TABLE `CJ_opportunities`
  MODIFY `opportunityID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `CJ_pain_points`
--
ALTER TABLE `CJ_pain_points`
  MODIFY `painPointID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `CJ_personas`
--
ALTER TABLE `CJ_personas`
  MODIFY `personaID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `CJ_projects`
--
ALTER TABLE `CJ_projects`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `CJ_project_shared_users`
--
ALTER TABLE `CJ_project_shared_users`
  MODIFY `projectUserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `CJ_stages`
--
ALTER TABLE `CJ_stages`
  MODIFY `stageID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=215;
--
-- AUTO_INCREMENT for table `CJ_technologies`
--
ALTER TABLE `CJ_technologies`
  MODIFY `technologyID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `CJ_thinking`
--
ALTER TABLE `CJ_thinking`
  MODIFY `thinkingID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `CJ_users`
--
ALTER TABLE `CJ_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `CJ_user_journeys`
--
ALTER TABLE `CJ_user_journeys`
  MODIFY `userJourneyID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `CJ_user_needs`
--
ALTER TABLE `CJ_user_needs`
  MODIFY `userNeedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `CJ_actions`
--
ALTER TABLE `CJ_actions`
  ADD CONSTRAINT `cj_actions_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_challenges`
--
ALTER TABLE `CJ_challenges`
  ADD CONSTRAINT `cj_challenges_ibfk_1` FOREIGN KEY (`personaID`) REFERENCES `cj_personas` (`personaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_feelings`
--
ALTER TABLE `CJ_feelings`
  ADD CONSTRAINT `cj_feelings_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_frustrations`
--
ALTER TABLE `CJ_frustrations`
  ADD CONSTRAINT `cj_frustrations_ibfk_1` FOREIGN KEY (`personaID`) REFERENCES `cj_personas` (`personaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_goals`
--
ALTER TABLE `CJ_goals`
  ADD CONSTRAINT `cj_goals_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_goals_persona`
--
ALTER TABLE `CJ_goals_persona`
  ADD CONSTRAINT `cj_goals_persona_ibfk_1` FOREIGN KEY (`personaID`) REFERENCES `cj_personas` (`personaID`);

--
-- Constraints for table `CJ_images`
--
ALTER TABLE `CJ_images`
  ADD CONSTRAINT `cj_images_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_motavations`
--
ALTER TABLE `CJ_motavations`
  ADD CONSTRAINT `cj_motavations_ibfk_1` FOREIGN KEY (`personaID`) REFERENCES `cj_personas` (`personaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_needs`
--
ALTER TABLE `CJ_needs`
  ADD CONSTRAINT `cj_needs_ibfk_1` FOREIGN KEY (`personaID`) REFERENCES `cj_personas` (`personaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_opportunities`
--
ALTER TABLE `CJ_opportunities`
  ADD CONSTRAINT `cj_opportunities_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_pain_points`
--
ALTER TABLE `CJ_pain_points`
  ADD CONSTRAINT `cj_pain_points_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_personas`
--
ALTER TABLE `CJ_personas`
  ADD CONSTRAINT `cj_personas_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `cj_projects` (`projectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_projects`
--
ALTER TABLE `CJ_projects`
  ADD CONSTRAINT `cj_projects_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `cj_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_project_shared_users`
--
ALTER TABLE `CJ_project_shared_users`
  ADD CONSTRAINT `cj_project_shared_users_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `cj_projects` (`projectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cj_project_shared_users_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `cj_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_stages`
--
ALTER TABLE `CJ_stages`
  ADD CONSTRAINT `cj_stages_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_technologies`
--
ALTER TABLE `CJ_technologies`
  ADD CONSTRAINT `cj_technologies_ibfk_1` FOREIGN KEY (`personaID`) REFERENCES `cj_personas` (`personaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_thinking`
--
ALTER TABLE `CJ_thinking`
  ADD CONSTRAINT `cj_thinking_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_user_journeys`
--
ALTER TABLE `CJ_user_journeys`
  ADD CONSTRAINT `cj_user_journeys_ibfk_2` FOREIGN KEY (`personaID`) REFERENCES `cj_personas` (`personaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cj_user_journeys_ibfk_1` FOREIGN KEY (`projectID`) REFERENCES `cj_projects` (`projectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CJ_user_needs`
--
ALTER TABLE `CJ_user_needs`
  ADD CONSTRAINT `cj_user_needs_ibfk_1` FOREIGN KEY (`userJourneyID`) REFERENCES `cj_user_journeys` (`userJourneyID`) ON DELETE CASCADE ON UPDATE CASCADE;
