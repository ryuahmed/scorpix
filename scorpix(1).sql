-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2018 at 08:13 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scorpix`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirmation`
--

CREATE TABLE `confirmation` (
  `user_id` varchar(40) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `confirmation`
--

INSERT INTO `confirmation` (`user_id`, `code`) VALUES
('ryu', '5fdde600'),
('ryu', '94694600'),
('ryu', '1463400'),
('ryu', '43ea8600'),
('ryu', '48a90a00'),
('ryu', '9806a400'),
('ryu', '438643c0');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `fid` varchar(40) NOT NULL,
  `f_name` varchar(40) NOT NULL,
  `f_price` varchar(6) NOT NULL,
  `link` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`fid`, `f_name`, `f_price`, `link`) VALUES
('0001', 'Popcorn - Large', '100', 'popcorn'),
('0002', 'Popcorn - Medium', '80', 'popcorn'),
('0003', 'Popcorn - Small', '100', 'popcorn'),
('0004', 'Soft Drinks (Pepsi/Fanta/Dew)- Large', '100', 'drinks'),
('0005', 'Soft Drinks (Pepsi/Fanta/Dew)- Small', '70', 'drinks'),
('0006', 'Burger', '220', 'burger'),
('0007', 'French Fry - Large', '100', 'frenchfry'),
('0008', 'French Fry - Small', '60', 'frenchfry'),
('0009', 'Pizza - Slice', '120', 'Pizza'),
('0010', 'Chiecken Nuggets', '150', 'nuggets');

-- --------------------------------------------------------

--
-- Table structure for table `hall`
--

CREATE TABLE `hall` (
  `h_id` varchar(40) NOT NULL,
  `h_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hall`
--

INSERT INTO `hall` (`h_id`, `h_type`) VALUES
('111', 'Normal'),
('112', 'Normal'),
('113', 'Premium'),
('114', 'Premium'),
('115', 'V.I.P.');

-- --------------------------------------------------------

--
-- Table structure for table `hall_description`
--

CREATE TABLE `hall_description` (
  `h_type` varchar(40) NOT NULL,
  `h_d` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hall_description`
--

INSERT INTO `hall_description` (`h_type`, `h_d`) VALUES
('Normal', ''),
('Premium', ''),
('V.I.P.', '');

-- --------------------------------------------------------

--
-- Table structure for table `hall_seat`
--

CREATE TABLE `hall_seat` (
  `hall_type` varchar(40) NOT NULL,
  `seat_type` varchar(40) NOT NULL,
  `row` varchar(40) NOT NULL,
  `colum` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hall_seat`
--

INSERT INTO `hall_seat` (`hall_type`, `seat_type`, `row`, `colum`) VALUES
('Normal', 'Premium', '9', '18'),
('Normal', 'Reguler', '4', '18'),
('Premium', 'Premium', '8', '19'),
('Premium', 'Reguler', '3', '19'),
('V.I.P.', 'Premium', '7', '10'),
('V.I.P.', 'Reguler', '3', '10');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `sender` varchar(40) NOT NULL,
  `reciver` varchar(40) NOT NULL,
  `data` text NOT NULL,
  `date` varchar(11) NOT NULL,
  `msg_id` varchar(6) NOT NULL,
  `seen` varchar(1) DEFAULT NULL,
  `subject` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`sender`, `reciver`, `data`, `date`, `msg_id`, `seen`, `subject`) VALUES
('akash', 'ryu', 'welcome to our cinema theater', '10-8-2018', '000001', '1', 'Welcome'),
('akash', 'ryu', 'asfasdasdfgfadg', '20-11-1996', '000002', '1', 'happy birthday'),
('Auto', 'ryu', 'You have bought 6 of 10001for 29-9-2018 at 12:00,  hall type : Premium,  seat type : Reguler, show hte give code to counter and gate ticket : 9806a400', '28-08-2018', '3', '1', 'Ticket Confirmation'),
('Auto', 'ryu', 'You have bought 6 of A Quiet Placefor 29-9-2018 at 12:00,  hall type : Premium,  seat type : Reguler, show hte give code to counter and gate ticket : 438643c0', '28-08-2018', '4', '1', 'Ticket Confirmation');

-- --------------------------------------------------------

--
-- Stand-in structure for view `max_msg`
-- (See below for the actual view)
--
CREATE TABLE `max_msg` (
`mx` varchar(6)
);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `name` varchar(40) NOT NULL,
  `id` varchar(16) NOT NULL,
  `director` varchar(40) NOT NULL,
  `realease_date` date NOT NULL,
  `run_time` varchar(15) NOT NULL,
  `cast` text NOT NULL,
  `synop` text NOT NULL,
  `type` varchar(2) NOT NULL,
  `status` varchar(15) NOT NULL,
  `poster` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`name`, `id`, `director`, `realease_date`, `run_time`, `cast`, `synop`, `type`, `status`, `poster`) VALUES
('A Quiet Place', '10001', 'John Krasinski', '2018-04-06', '1h 30min', 'Emily Blunt, John Krasinski, Millicent Simmonds', 'In a post-apocalyptic world, a family is forced to live in silence while hiding from monsters with ultra-sensitive hearing. ', '2D', 'Now Showing', 'a quiet place '),
('Ant-Man and the Wasp', '10002', 'Peyton Reed', '2018-07-06', '1h 58min ', 'Paul Rudd, Evangeline Lilly, Michael Peña', 'As Scott Lang balances being both a Super Hero and a father, Hope van Dyne and Dr. Hank Pym present an urgent new mission that finds the Ant-Man fighting alongside The Wasp to uncover secrets from their past. ', '3D', 'Now Showing', 'antman and wasp'),
('Blade Runner 2049 ', '10003', 'Denis Villeneuve', '2017-10-06', '2h 44min', 'Harrison Ford, Ryan Gosling, Ana de Armas', 'A young blade runner\'s discovery of a long-buried secret leads him to track down former blade runner Rick Deckard, who\'s been missing for thirty years.', '3D', 'Now Showing', 'blade runner 2049'),
('The Dark Knight Rises', '10004', 'Christopher Nolan', '2012-07-20', ' 2h 44min', 'Christian Bale, Tom Hardy, Anne Hathaway', 'Eight years after the Joker\'s reign of anarchy, Batman, with the help of the enigmatic Catwoman, is forced from his exile to save Gotham City, now on the edge of total annihilation, from the brutal guerrilla terrorist Bane.', '3D', 'Now Showing', 'dark knight rises'),
('Die Hard', '10005', 'John McTiernan', '1998-07-20', '2h 12min', 'Bruce Willis, Alan Rickman, Bonnie Bedelia', 'John McClane, officer of the NYPD, tries to save his wife Holly Gennaro and several others that were taken hostage by German terrorist Hans Gruber during a Christmas party at the Nakatomi Plaza in Los Angeles. ', '2D', 'Special', 'diehard'),
('Dunkirk', '10006', 'Christopher Nolan', '2017-07-21', '1h 46min', 'Fionn Whitehead, Barry Keoghan, Mark Rylance', 'Allied soldiers from Belgium, the British Empire and France are surrounded by the German Army, and evacuated during a fierce battle in World War II. ', '2D', 'Now Showing', 'dunkirk'),
('Inception', '10007', 'Christopher Nolan', '2010-07-16', '2h 28min ', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'A thief, who steals corporate secrets through the use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO. ', '3D', 'Now Showing', 'inception'),
('Interstellar', '10008', 'Christopher Nolan', '2014-11-07', ' 2h 49min', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival. ', '3D', 'Now Showing', 'interstellar'),
('Incredibles 2', '10009', 'Brad Bird', '2018-06-15', '1h 58min ', 'Craig T. Nelson, Holly Hunter, Sarah Vowell', 'Bob Parr (Mr. Incredible) is left to care for the kids while Helen (Elastigirl) is out saving the world.', '3D', 'Now Showing', 'incredibles2'),
('Mission: Impossible - Fallout', '10010', 'Christopher McQuarrie', '2018-07-27', '2h 27min', 'Tom Cruise, Henry Cavill, Ving Rhames', 'Ethan Hunt and his IMF team, along with some familiar allies, race against time after a mission gone wrong. ', '3D', 'Up Coming', 'mission impossible 6 '),
('Spider-Man: Into the Spider-Verse', '10011', 'Bob Persichetti', '2018-12-14', 'Unknown', ' Nicolas Cage, Hailee Steinfeld, Jake Johnson', 'Spider-Man crosses parallel dimensions and teams up with the Spider-Men of those dimensions to stop a threat to all reality. ', '3D', 'Up Coming', 'spider man into the spider verse'),
('Star Wars: The Last Jedi', '10012', 'Rian Johnson', '2017-12-15', '2h 32min', 'Daisy Ridley, John Boyega, Mark Hamill', 'Rey develops her newly discovered abilities with the guidance of Luke Skywalker, who is unsettled by the strength of her powers. Meanwhile, the Resistance prepares for battle with the First Order. ', '3D', 'Now Showing', 'star war last jedi'),
('The Greatest Showman', '10013', 'Michael Gracey', '2016-12-20', '1h 45min ', 'Hugh Jackman, Michelle Williams, Zac Efron', 'Celebrates the birth of show business, and tells of a visionary who rose from nothing to create a spectacle that became a worldwide sensation. ', '2D', 'Now Showing', 'the greatest showman'),
('Titanic', '10014', 'James Cameron', '1997-12-19', '3h 14min ', 'Leonardo DiCaprio, Kate Winslet, Billy Zane ', 'A seventeen-year-old aristocrat falls in love with a kind but poor artist aboard the luxurious, ill-fated R.M.S. Titanic.', '2D', 'Special', 'titanic'),
('Venom ', '10015', 'Ruben Fleischer', '2018-10-05', 'Unknown', 'Tom Hardy, Michelle Williams, Jenny Slate', 'When Eddie Brock acquires the powers of a symbiote, he will have to release his alter-ego \"Venom\" to save his life. ', '3D', 'Up Coming', 'venom'),
('Ralph Breaks the Internet', '10016', 'Phil Johnston', '2018-11-21', 'Unkown', 'Kristen Bell, Mandy Moore, Kelly Macdonald', 'Six years after the events of \"Wreck-It Ralph,\" Ralph and Vanellope, now friends, discover a wi-fi router in their arcade, leading them into a new adventure.', '3D', 'Up Coming', 'wreck it ralph 2');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` varchar(40) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `added` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `added`) VALUES
('0001', 'Mission: \"Impossible - Fallout\"', 'Mission: \"Impossible - Fallout\" Debuts With Franchise-Best 61.5M Opening\',\'29 July 2018\',\'This weekend saw Paramount\'s Mission: Impossible-Fallout top the weekend box office with the franchise\'s largest three-day opening as well as star Tom Cruise\'s second largest opening of his career. Meanwhile, Warner Bros.\'s animated feature Teen Titans Go! To the Movies struggled and fell short of expectations. Overall, the weekend was up not 6percent compared to last weekend and up not 8percent compared to the same weekend last year. With an estimated 61.5 million dollar, Paramount\'s Mission: Impossible - Fallout fell a bit shy of Mojo\'s pre-weekend expectations, but still managed to deliver the franchise\'s largest three-day opening, topping the 57.8 million opening for Mission: Impossible II back in 2000. The opening also represents the second largest debut for Tom Cruise after the 64.8 million debut for War of the Worlds in 2005 and for Paramount this is the studio\'s largest opening since 2014\'s Teenage Mutant Ninja Turtles (65.5m dollar). Given the film\'s position as the last', '2018-08-28'),
('0002', 'Stranger Things Summer 2019 Return', '‘Stranger Things’: Netflix Boss Confirms Summer 2019 Return, Talks “Bigger and Better” Season 3 & Series End Date – TCA\',\'29 July 2018\',\'Stranger Things is officially returning to its summer stomping grounds. During the Netflix executive session, VP original content Cindy Holland confirmed that Season 3 of the hugely popular 1980s comedy-drama, from creators/executive producers the Duffer brothers and executive producer/director Shawn Levy, will be released next summer, something that had been teased in the show’s recent first-look image.\r\n\r\n“It’s a handcrafted show,” she said. “The Duffer brothers and Shawn Levy have worked really hard, and they understand the stakes are high. They want to deliver something bigger and better than what they did last year. And so they really want to take the time to get it right.”\r\n\r\nHolland elaborated after the panel on the delay (Season 2 debuted in October 2017). “More special effects, it’s going to be a really exciting season.”', '2018-08-27'),
('0003', 'Kevin Smith Teases Massive Big Budget Project', '\'125\',\'Kevin Smith Teases “Massive” Big Budget Project, Hopes To Release Next Year\',\'30 July 2018\',\'According to Box Office Mojo, Smith’s highest grossing movie was 2010’s Cop Out which earned $44.8 million at the box office with a $30 million budget. But of his directorial slate, it was 2004’s Jersey Girl that had the biggest budget. With its $35 million budget, it earned over $25 million at the box office.\r\n\r\nNonetheless, the guessing game has started with people automatically thinking it is something in the comic book/fanboy universe. He went on record in June saying that he wouldn’t be getting behind a camera for a Marvel or Star Wars movie any time soon.\'', '2018-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `now_showing`
--

CREATE TABLE `now_showing` (
  `movie_id` varchar(40) NOT NULL,
  `h_id` varchar(40) NOT NULL,
  `time` varchar(100) NOT NULL,
  `At` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `now_showing`
--

INSERT INTO `now_showing` (`movie_id`, `h_id`, `time`, `At`) VALUES
('10001', '114', '12:00', 'Matinee'),
('10002', '112', '1:30', 'Matinee'),
('10002', '113', '11:30', 'Matinee'),
('10002', '113', '7:50', 'Evening'),
('10003', '115', '3:00', 'Evening'),
('10004', '111', '10:00', 'Matinee'),
('10004', '111', '8:00', 'Evening'),
('10006', '113', '3:30', 'Evening'),
('10007', '111', '1:20', 'Matinee'),
('10007', '111', '4:50', 'Evening'),
('10008', '114', '5:00', 'Evening'),
('10009', '115', '6:00', 'Evening'),
('10012', '112', '10:20', 'Matinee'),
('10012', '112', '8:00', 'Evening'),
('10013', '112', '5:00', 'Evening');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `poll_id` varchar(6) NOT NULL,
  `ques` text NOT NULL,
  `tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`poll_id`, `ques`, `tag`) VALUES
('000001', 'Which hall you prefer most ?', 'Vote for hall'),
('000002', 'Which movie you want to watch next season ?', 'Vote for movie');

-- --------------------------------------------------------

--
-- Table structure for table `poll_option`
--

CREATE TABLE `poll_option` (
  `pid` varchar(6) NOT NULL,
  `p_option` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_option`
--

INSERT INTO `poll_option` (`pid`, `p_option`) VALUES
('000001', 'Normal'),
('000001', 'Premium'),
('000001', 'V.I.P'),
('000002', 'Mission Impossible 6'),
('000002', 'Ralph Breaks the Internet'),
('000002', 'Spider-Man: Into the Spider-Verse'),
('000002', 'Venom');

-- --------------------------------------------------------

--
-- Table structure for table `poll_show`
--

CREATE TABLE `poll_show` (
  `pid` varchar(6) NOT NULL,
  `poll_sec` varchar(10) NOT NULL,
  `start_date` varchar(11) NOT NULL,
  `end_date` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_show`
--

INSERT INTO `poll_show` (`pid`, `poll_sec`, `start_date`, `end_date`) VALUES
('000001', 'R1', '2-8-2018', NULL),
('000002', 'R2', '2-8-2018', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poll_vote`
--

CREATE TABLE `poll_vote` (
  `pid` varchar(6) NOT NULL,
  `uid` varchar(40) NOT NULL,
  `op` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_vote`
--

INSERT INTO `poll_vote` (`pid`, `uid`, `op`) VALUES
('000001', '', 'Normal'),
('000001', 'akash', 'Premium'),
('000001', 'Guest-2018-08-21-02:44:39am', 'V.I.P'),
('000001', 'Guest-2018-08-21-02:44:57am', 'V.I.P'),
('000001', 'Guest-2018-08-21-02:45:22am', 'Normal'),
('000001', 'Guest-2018-08-21-02:45:50am', 'Premium'),
('000001', 'Guest-2018-08-21-02:46:45am', 'Premium'),
('000001', 'Guest-2018-08-21-02:47:18am', 'Premium'),
('000001', 'Guest-2018-08-21-05:01:12pm', 'V.I.P'),
('000001', 'Guest-2018-08-25-08:57:44pm', 'Normal'),
('000001', 'Guest-2018-08-25-08:59:47pm', 'Normal'),
('000001', 'Guest-2018-08-25-09:00:10pm', 'Premium'),
('000001', 'Guest-2018-08-25-09:04:07pm', 'V.I.P'),
('000001', 'Guest-2018-08-25-09:23:08pm', 'Normal'),
('000001', 'Guest-2018-08-25-09:25:04pm', 'Normal'),
('000001', 'Guest-2018-08-25-09:52:59pm', 'Normal'),
('000001', 'Guest-2018-08-25-09:57:33pm', 'Normal'),
('000001', 'Guest-2018-08-25-09:58:49pm', 'Premium'),
('000001', 'Guest-2018-08-25-09:59:20pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:01:30pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:04:21pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:06:52pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:09:18pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:10:50pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:11:12pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:11:30pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:11:48pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:15:34pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:16:39pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:17:09pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:18:02pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:23:19pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:25:18pm', 'Normal'),
('000001', 'Guest-2018-08-25-10:26:01pm', 'Normal'),
('000001', 'Guest-2018-08-25-11:26:46pm', 'Normal'),
('000001', 'Guest-2018-08-25-11:33:20pm', 'Normal'),
('000001', 'Guest-2018-08-25-11:33:37pm', 'V.I.P'),
('000001', 'Guest-2018-08-25-11:43:13pm', 'V.I.P'),
('000001', 'Guest-2018-08-26-12:01:11am', 'V.I.P'),
('000001', 'ryu', 'V.I.P'),
('000002', '', 'Venom'),
('000002', 'Guest-2018-08-25-11:43:06pm', 'Ralph Breaks the Internet'),
('000002', 'Guest-2018-08-25-11:48:00pm', 'Mission Impossible 6'),
('000002', 'Guest-2018-08-25-11:48:16pm', 'Mission Impossible 6'),
('000002', 'Guest-2018-08-26-12:01:05am', 'Mission Impossible 6'),
('000002', 'ryu', 'Mission Impossible 6');

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

CREATE TABLE `poster` (
  `movie_id` varchar(32) NOT NULL,
  `show_pic` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`movie_id`, `show_pic`) VALUES
('10001', 'not'),
('10002', 'active'),
('10003', 'not'),
('10004', 'not'),
('10005', 'active'),
('10006', 'not'),
('10007', 'not'),
('10008', 'active'),
('10009', 'active'),
('10010', 'active'),
('10011', 'active'),
('10012', 'not'),
('10013', 'active'),
('10014', 'active'),
('10015', 'active'),
('10016', 'active');

-- --------------------------------------------------------

--
-- Stand-in structure for view `show_this_poll`
-- (See below for the actual view)
--
CREATE TABLE `show_this_poll` (
`pid` varchar(6)
,`poll_sec` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `show_time`
--

CREATE TABLE `show_time` (
  `h_id` varchar(40) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `show_time`
--

INSERT INTO `show_time` (`h_id`, `time`) VALUES
('111', '1.20'),
('111', '10.00'),
('111', '4.50'),
('111', '8.00'),
('112', '1.30'),
('112', '10.20'),
('112', '5.00'),
('112', '8.00'),
('113', '11.30'),
('113', '3.30'),
('113', '7.50'),
('114', '12.00'),
('114', '5.00'),
('115', '3.00'),
('115', '6.30');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `movie_id` varchar(32) NOT NULL,
  `status` varchar(15) NOT NULL,
  `caption` varchar(32) NOT NULL,
  `link` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`movie_id`, `status`, `caption`, `link`) VALUES
('10004', 'not', 'The Dark Knight Rises', 'dark knight rises'),
('10006', 'active', 'Dunkrik', 'dunkrik'),
('10007', 'active', 'Inception', 'inception'),
('10008', 'active', 'Interstellar', 'interstellar');

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

CREATE TABLE `sold` (
  `ticket_id` varchar(40) NOT NULL,
  `movie_id` varchar(40) NOT NULL,
  `hall_id` varchar(40) NOT NULL,
  `time` varchar(40) NOT NULL,
  `seat` varchar(5) NOT NULL,
  `user_id` varchar(40) NOT NULL,
  `date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold`
--

INSERT INTO `sold` (`ticket_id`, `movie_id`, `hall_id`, `time`, `seat`, `user_id`, `date`) VALUES
('S1235CV2', '10002', '113', '11:30', 'K19.p', 'ryu', '10-8-2018'),
('S1235CV3', '10002', '113', '11:30', 'K18.p', 'ryu', '10-8-2018'),
('S1235CV4', '10003', '115', '3:00', 'J10.p', 'ryu', '6-8-2018'),
('S1235CV5', '10003', '115', '3:00', 'J9.p ', 'ryu', '6-8-2018'),
('S1235CV6', '10003', '115', '3:00', 'J9.p ', 'akash', '30-9-2018'),
('S1235CV7', '10003', '115', '3:00', 'J8.p ', 'akash', '30-9-2018'),
('S1235CV8', '10003', '115', '3:00', 'J7.p ', 'akash', '30-9-2018'),
('S1235CV9', '10003', '115', '3:00', 'J6.p ', 'akash', '30-9-2018'),
('S1235CW0', '10003', '115', '3:00', 'J5.p ', 'akash', '30-9-2018'),
('S1235CW1', '10003', '115', '3:00', 'J4.p ', 'akash', '30-9-2018');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `h_type` varchar(40) NOT NULL,
  `m_type` varchar(40) NOT NULL,
  `time` varchar(40) NOT NULL,
  `price` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`h_type`, `m_type`, `time`, `price`) VALUES
('Normal', '2D', 'Evening', 250),
('Normal', '2D', 'Matinee', 200),
('Normal', '3D', 'Evening', 350),
('Normal', '3D', 'Matinee', 300),
('Premium', '2D', 'Evening', 350),
('Premium', '2D', 'Matinee', 300),
('Premium', '3D', 'Evening', 450),
('Premium', '3D', 'Matinee', 400),
('V.I.P.', '2D', 'Evening', 550),
('V.I.P.', '2D', 'Matinee', 500),
('V.I.P.', '3D', 'Evening', 700),
('V.I.P.', '3D', 'Matinee', 600);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `First_name` varchar(32) NOT NULL,
  `Last_name` varchar(32) NOT NULL,
  `User_name` varchar(32) NOT NULL,
  `Email` varchar(46) NOT NULL,
  `Password` varchar(46) NOT NULL,
  `Phone_no` varchar(11) NOT NULL,
  `Birth_date` varchar(11) NOT NULL,
  `position` varchar(20) NOT NULL,
  `dp` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`First_name`, `Last_name`, `User_name`, `Email`, `Password`, `Phone_no`, `Birth_date`, `position`, `dp`) VALUES
('Akash', 'Ahmed', 'akash', 'akash@gmail.com', '1234', '0156324986', '20-06-1993', 'Moderator', 'default.png'),
('a', 'a', 'ryu', 'a', 'a', 'a', '20-11-1996', 'User', 'default.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `watchlist`
-- (See below for the actual view)
--
CREATE TABLE `watchlist` (
`User_name` varchar(32)
,`name` varchar(40)
,`poster` varchar(150)
);

-- --------------------------------------------------------

--
-- Structure for view `max_msg`
--
DROP TABLE IF EXISTS `max_msg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `max_msg`  AS  select max(`inbox`.`msg_id`) AS `mx` from `inbox` ;

-- --------------------------------------------------------

--
-- Structure for view `show_this_poll`
--
DROP TABLE IF EXISTS `show_this_poll`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `show_this_poll`  AS  select `poll_show`.`pid` AS `pid`,`poll_show`.`poll_sec` AS `poll_sec` from `poll_show` where isnull(`poll_show`.`end_date`) ;

-- --------------------------------------------------------

--
-- Structure for view `watchlist`
--
DROP TABLE IF EXISTS `watchlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `watchlist`  AS  select distinct `user`.`User_name` AS `User_name`,`movie`.`name` AS `name`,`movie`.`poster` AS `poster` from ((`user` join `sold`) join `movie`) where ((`user`.`User_name` = `sold`.`user_id`) and (`sold`.`movie_id` = `movie`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `hall_description`
--
ALTER TABLE `hall_description`
  ADD PRIMARY KEY (`h_type`);

--
-- Indexes for table `hall_seat`
--
ALTER TABLE `hall_seat`
  ADD PRIMARY KEY (`hall_type`,`seat_type`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `reciver` (`reciver`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `now_showing`
--
ALTER TABLE `now_showing`
  ADD PRIMARY KEY (`movie_id`,`h_id`,`time`,`At`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `poll_option`
--
ALTER TABLE `poll_option`
  ADD PRIMARY KEY (`pid`,`p_option`);

--
-- Indexes for table `poll_show`
--
ALTER TABLE `poll_show`
  ADD PRIMARY KEY (`pid`,`poll_sec`,`start_date`);

--
-- Indexes for table `poll_vote`
--
ALTER TABLE `poll_vote`
  ADD PRIMARY KEY (`pid`,`uid`);

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `show_time`
--
ALTER TABLE `show_time`
  ADD PRIMARY KEY (`h_id`,`time`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `sold`
--
ALTER TABLE `sold`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sold_ibfk_2` (`hall_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`h_type`,`m_type`,`time`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hall_seat`
--
ALTER TABLE `hall_seat`
  ADD CONSTRAINT `hall_seat_ibfk_1` FOREIGN KEY (`hall_type`) REFERENCES `hall_description` (`h_type`);

--
-- Constraints for table `inbox`
--
ALTER TABLE `inbox`
  ADD CONSTRAINT `inbox_ibfk_2` FOREIGN KEY (`reciver`) REFERENCES `user` (`User_name`);

--
-- Constraints for table `poll_option`
--
ALTER TABLE `poll_option`
  ADD CONSTRAINT `poll_option_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `poll` (`poll_id`);

--
-- Constraints for table `poll_vote`
--
ALTER TABLE `poll_vote`
  ADD CONSTRAINT `poll_vote_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `poll` (`poll_id`);

--
-- Constraints for table `sold`
--
ALTER TABLE `sold`
  ADD CONSTRAINT `sold_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `sold_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`h_id`),
  ADD CONSTRAINT `sold_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`User_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
