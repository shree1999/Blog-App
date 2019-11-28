-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 02:44 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `addedby` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `aname`, `addedby`) VALUES
(1, '2019-11-13 19:58:57', 'Tom', 'tom1234', '', 'Shree'),
(2, '2019-11-15 08:52:49', 'Shanu', 'shanu786', '', 'Tom');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(70) DEFAULT NULL,
  `created_on` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `created_on`) VALUES
(2, 'Technology', 'Shree', '2019-11-11 22:18:55'),
(4, 'Sports', 'Shree', '2019-11-11 22:24:37'),
(5, 'Fitness', 'Shree', '2019-11-12 16:24:31'),
(6, 'News', 'Tom', '2019-11-20 08:31:32'),
(7, 'Entertainment', 'Tom', '2019-11-20 09:08:55'),
(8, 'Science', 'Tom', '2019-11-20 09:09:19'),
(9, 'Health', 'Tom', '2019-11-20 09:09:37'),
(10, 'Business', 'Tom', '2019-11-20 09:09:58'),
(11, 'food', 'Tom', '2019-11-20 16:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comments` varchar(500) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comments`, `approvedby`, `status`, `post_id`) VALUES
(13, '2019-11-20 10:39:20', 'Shreeansh', 'guptaShree@gmail.com', 'This is amazing to see how far we have achieved in Technology', 'Tom', 'ON', 34),
(14, '2019-11-20 15:51:10', 'shree', '000@gmail.com', 'gfdes', 'Tom', 'ON', 26);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(17, '2019-11-20 08:32:52', 'JSS opened CSBS Course', 'Technology', 'Tom', 'news-12-sjce.jpg', '                     To address the growing need of engineering talent with skills in digital technology, TCS, in partnership with leading academicians across India, has designed a curriculum for 4-year UG programme on Computer Science (CS) titled ‘Computer Science and Business Systems (CSBS).’                  '),
(19, '2019-11-20 08:47:34', 'JSS Hold Global Alumni Meet in USA ', 'News', 'Tom', 'aluminiMeet.jpg', 'The alumni of Sri Jayachamarajendra College of Engineering (SJCE), Mysuru, had organised a ‘Global Alumni Meet’ recently at San Jose, USA. \r\n\r\nThe programme was the first-of-its-kind in the history of SJCE Alumni Association. It was a memorable stage for the alumni who had graduated from this institution since 1968. This platform will be acting as a mentor for the upcoming students of SJCE or JSS Science & Technology University (JSS STU).'),
(20, '2019-11-20 08:49:57', 'JSS STU Signs MOU with American MNC', 'News', 'Tom', 'MNC.jpg', ' JSS Science and Technology University (JSS S&TU – SJCE), has signed an Memorandum of Understanding  (MoU) with Intuit India Product Development Centre Pvt. Ltd., Bengaluru, an American MNC recently. At present, technology at Engineering Colleges /Universities and industry are working collaboratively to create balanced learning and fostering innovation and creativity to solve practical technical challenges.'),
(21, '2019-11-20 09:00:03', 'A betrayal in the offing: Why Congress should give a second thought to allying with Shiv Sena', 'News', 'Tom', 'SONIA-Udhhav-1.jpg', 'To see the Congress’s compromise with the Shiv Sena, which was the first to have proudly claimed responsibility for the demolition of the Babri Masjid, was the last thing one could have imagined. By considering doing so, it has made it clear that the language of Hindutva will now be the common political language.\r\n\r\nVinayak Damodar Savarkar must be smiling. It can be said that Congress has seemingly turned its back on the legacy of Jawaharlal Nehru and Gandhi. The news of the party being close to sealing its pact with the Shiv Sena came on the eve of Nehru’s birthday. It is the cruelest tribute the party could have paid him. This is also Gandhi’s 150th birth anniversary. The Congress has shaken hands with the Shiv Sena, a party which demanded a Bharat Ratna for Savarkar, who is often seen as complicit in the conspiracy to assassinate Gandhi. Even if we ignore this, Savarkar certainly led the ideological opposition to the Gandhian idea of co-living and nation-building. By considering aligning with his followers, the Congress has shown that his viewpoint can be accommodated.'),
(22, '2019-11-20 09:12:20', '\'Tanhaji: The Unsung Warrior\' trailer: Karan Johar, Abhishek Bachchan and other B-town celebs laud Ajay Devgn and Saif Ali Khan\'s film', 'Entertainment', 'Tom', 'imgad.jfif', 'The makers of \'Tanhaji: The Unsung Warrior\' dropped in the trailer of the magnum opus featuring Ajay Devgn, Saif Ali Khan and Kajol in lead roles. The trailer that gives us glimpses of all that lead up to the battle of Kondhana that was lead by the brave Maratha soldier Tanhaji Malusare.\r\nIn the three minute twenty-one seconds, long trailer Ajay Devgn\'s promising act as the unsung Maratha warrior- Tanhaji Malusare, Kajol\'s stint as his wife Savitribai Malusare and Saif\'s ferocious avatar as the antagonist Uday Bhan is something to watch out for in the film. The grandeur of the film, definitely speak volumes about the Maratha empire and its glory.'),
(23, '2019-11-20 09:14:51', 'Method to detect pulmonary fibrosis discovered', 'Health', 'Tom', 'health.jpeg', 'Washington: As the researchers have discovered how the lung disease idiopathic pulmonary fibrosis (IPF) progresses, they will now be able to provide a method to discover new treatment targets for the disease.\r\n\r\nThe study, led by Naftali Kaminski, M.D., the Boehringer-Ingelheim Endowed Professor of Internal Medicine and chief of the Section of Pulmonary, Critical Care, and Sleep Medicine at Yale School of Medicine, and John E.\r\n\r\nMcDonough, instructor, and researcher at the medical school appeared in -- JCI.\r\n\r\nIn the study, researchers examined differentially affected regions in the lungs obtained from individuals with IPF and found that what looks like normal lung is already undergoing changes in specific genes.\r\n\r\nThey then tracked how these genes continue to change, increasing or decreasing, as the disease progresses.\r\n\r\nA unique feature of the paper, said Kaminski, is that it provides the first computational model of disease progression in the IPF lung and is accompanied by an interactive website exploring this model.\r\n\r\nKaminski believes that widespread access to the data will accelerate research into new therapies in IPF.\r\n\r\nAlthough Kaminski noted that scientists at Yale and elsewhere have made \"substantial scientific progress\" on IPF in recent years, there are few treatment options.\r\n\r\nIPF is a chronic disease in which the lungs become increasingly scarred and unable to function; it affects some 200,000 people in the U.S., with about 30,000 new cases each year.\r\n\r\nFifty per cent of patients with IPF will die in three to five years following diagnosis, and the cause of IPF is unknown.\r\n\r\nThe two FDA-approved drugs to treat IPF slow the progress of the disease, but do not reverse it.\r\n\r\n\"The drugs may not be pleasant, but they work,\" said Kaminski, adding that, most importantly, \"There\'s hope on the horizon.\"\r\n\r\nDrug trials for IPF are ongoing, and this latest research, he said, should provide opportunities for researchers to identify new potential drug targets.\r\n\r\n\"My group has felt for years that to develop interventions for IPF that are more effective, we need to understand how the disease progresses in the human lung,\" Kaminski said.\r\n\r\nAnimal models for IPF work to show how pulmonary fibrosis impacts the lungs, but not what regulates changes at the genetic level to drive IPF progression in humans.\r\n\r\nThe investigators used a unique system that allowed them to quantify the amount of fibrosis in differentially affected regions in the lung and then to measure the expression of all the genes in the human genome in exactly the same region by RNA sequencing.\r\n\r\nThey also measured microRNAs, small non-coding RNAs known to regulate the expression of genes.\r\n\r\nThey applied advanced systems biology methods to identify tracks of gene expression associated with the progression of IPF in the lung and the molecules that regulate them.\r\n\r\nUsing this approach, they made three key findings. First, they discovered that what looked like normal tissue in the diseased lung was in fact abnormal.\r\n\r\nSecond, they identified gene expression changes that were specific to tissue associated with early, progressive and end-stage fibrosis. Third, they identified distinct molecular regulators for each of these stages.'),
(24, '2019-11-20 09:16:08', '40% Parents Struggle to Differentiate Mood Swings and Signs of Depression in Kids, Says Study', 'Health', 'Tom', 'children-depression.jpg', 'Telling the difference between a teen\'s normal ups and downs or something bigger is among the top challenges parents face while identifying depression among the youth, says a new study.\r\n\r\nForty per cent of parents struggle to differentiate between normal mood swings and signs of depression, while 30 per cent are tricked as their child hides his/her feelings well, according to a new national poll in the US.\r\n\r\nThe C.S. Mott Children\'s Hospital National Poll on Children\'s Health at the University of Michigan, is based on responses from 819 parents with at least one child in middle school, junior high, or high school.\r\n\r\n\"In many families, the preteen and teen years bring dramatic changes both in youth behaviour and in the dynamic between parents and children,\" said poll co-director Sarah Clark. \"These transitions can make it particularly challenging to get a read on children\'s emotional state and whether there is possible depression,\" Clark added.\r\n\r\nAccording to the researchers, some parents might be overestimating their ability to recognise depression in the mood and behaviour of their own child. An overconfident parent may fail to pick up on the subtle signals that something is amiss. The poll also suggests that the topic of depression is all too familiar for middle and high school students.\r\n\r\nOne in four parents say their child knows a peer or classmate with depression, and one in 10 say their child knows a peer or classmate who has died by suicide. This level of familiarity with depression and suicide is consistent with recent statistics showing a dramatic increase in suicide among US youth over the past decade.\r\n\r\nRising rates of suicide highlight the importance of recognizing depression in youth. Compared to the ratings of their own ability, parents polled were also less confident that their preteens or teens would recognize depression in themselves. \"Parents should stay vigilant on spotting any signs of potential depression in kids, which may vary from sadness and isolation to anger, irritability and acting out,\" said Clark.\r\n\r\nMost parents also believe schools should play a role in identifying potential depression, with seven in 10 supporting depression screening starting in middle school, the study said.\r\n\r\nFollow News18 Lifestyle for more\r\n\r\n'),
(25, '2019-11-20 09:21:58', 'Karnataka by-poll: Dissent brews in BJP', 'News', 'Tom', 'bl08think2FT2G0R6MBGGR3jpgjpg.jfif', 'The ruling Bharatiya Janata Party (BJP) is besieged with rebellion in 7-8 seats of the 15 Karnataka Assembly constituencies which are going to by-elections on December 5. The party must win eight seats to ensure a majority in the House.\r\n\r\nBy-election was necessitated following 15 rebel MLAs belonging to Congress and Janata Dal-Secular JD(S) resigning and later joining the BJP.\r\n\r\nRebellious MPs\r\nAfter the deadline to file nomination ended on Monday, the BJP is facing severe rebellion in 7-8 seats and there is no cohesion among its workers, local leaders and the official candidates.'),
(26, '2019-11-20 09:23:21', 'Happy Birthday Sushmita Sen: 5 Times India\'s first Miss Universe Proved She is Fitness Queen', 'Fitness', 'Tom', 'Rohman-Shawl-Sushmita-Sen.jpg', 'The first Miss Universe from India, Sushmita Sen, who celebrates her birthday on November 19, was crowned in 1994. Following her tenure as Miss Universe, she acted in several Hindi as well as a few Tamil (Ratchagan) and Bengali (Nirbaak) films.\r\n\r\nThe actress, who debuted with the film Dastak in 1996, has also worked in box office hits like Sirf Tum, Biwi No 1, Aankhen and Main Hoon Na. A prolific social media personality, she created waves when she decided to become single mum to a baby girl in 2000, and adopted a second child in 2010.\r\n\r\nShe is also an avid body fitness advocate and regularly takes to her Instagram account to post videos and images of her training sessions -- often with boyfriend Rohman Shawl -- promoting healthy living. On the former Miss Universe\'s birthday, here\'s looking at 5 times she proved she is a fitness queen:\r\n\r\nWorking with the rings\r\n\r\nAn inspiration to all, Sushmita\'s most recent workout video shows her working out using still rings. She captioned the post as \"put a ring on it\" along with the trending hashtags #discipline and #stability to promote a healthy lifestyle.'),
(27, '2019-11-20 09:27:30', 'Disha Patani shows off her parkour moves, gives major fitness goals', 'Fitness', 'Tom', 'Disha-Patani-fitness.webp', 'Disha Patani, who is known for her stellar workout videos, recently shared on Instagram a clip of her trying the “kong vault”. The movement that involves jumping over an obstacle is part of parkour, a training exercise developed by the military. Parkour practitioners aim to get from one point to another in the fastest and most efficient manner without using any equipment.\r\n\r\n\r\nAdvertising\r\nThe Malang Actor captioned the video, “After ages trying my hand on kong vault, back to training with @Nadeemakhtarparkour88.”'),
(28, '2019-11-20 09:28:10', 'Katrina Kaif shares secret to her flat tummy; take notes', 'Fitness', 'Tom', 'katrina-1.webp', 'Bollywood is not just the go-to place for fashion inspiration, it is also for those looking for some fitness motivation. Bollywood celebrities always have their fitness game on-point with many sharing the secret to their toned physique and even their workout sessions on social media. Recently, Katrina Kaif spilled the beans on how she maintains her flat tummy, giving key insights from her fitness regimen.\r\n\r\nIn an interview with GQ magazine, the Bharat actor shared what helped transform her body. Her Instagram feed is full of her gym photos which show that Kaif trains like a beast. From rigorous choreography sessions to tough gym routines, the actor invests much of her time performing arduous activities to keep herself fit. Take a look.'),
(30, '2019-11-20 09:33:55', 'Sushant Singh Rajput\'s Dil Bechara, Hindi Adaptation of \'The Fault in Our Stars\', to Release in May 2020', 'Entertainment', 'Tom', 'EJZg5QIU0AIAXeI.jfif', 'Directed by Mukesh Chhabra, Dil Bechara is a remake of the popular Hollywood film, The Fault in our Stars, which was based on the novel of the same name written by John Green.\r\n\r\nSanjana Sanghi, who plays the female lead in the film, had made her Bollywood debut in Imtiaz Ali\'s 2011 blockbuster Rockstar, starring Ranbir Kapoor and Nargis Fakri.\r\n\r\nShe shared the new release date of the film on Instagram and wrote, \"This extraordinary love story so close to my heart will now be releasing on 8th May 2020, only in cinemas. #DilBechara @sushantsinghrajput @castingchhabra @foxstarhindi @arrahman.\"'),
(31, '2019-11-20 09:34:57', 'Akshay Kumar, Kareena Kapoor\'s New Good Newwz Poster Unveiled Ahead of Trailer Release', 'Entertainment', 'Tom', 'Good-Newwz-poster.jpg', 'Good Newwz will see a team of funny actors come together for an all out entertainer. Akshay Kumar, Kareena Kapoor, Kiara Advani and Diljit Dosanjh are playing the lead roles and new poster shows them huddled while they are surrounded by a sperm. The makers have created a lot of anticipation around the trailer release and the new poster seems like a tease before the first look of the film is unveiled later today.\r\n\r\nThe new poster is again filled with plethora of colours as Kareena hugs Akshay and Kiara hugs Diljit. Earlier posters had hinted that a confusion may reign over the two couples as both Diljit and Akshay\'s characters from the film were seen squeezed between pregnant bellies of the two actresses. The new poster just adds to the hype of the film which releases on December 27. Check out the new and old posters of Good Newwz below and be back for more updates and news on the trailer release of the film.'),
(32, '2019-11-20 09:37:23', 'Alibaba Cloud technology powered $1B of GMV in 68 seconds with zero downtime during 11.11.', 'Technology', 'Tom', 'Imageruh31574192974569jpg.png', 'What’s an ecommerce platform without the tech engine that powers it? Without the powerful backend, they could very well be just an instrument that entices but never delivers. And when millions are filling their carts and checking out all at the same time, the technology has to be no less than the one powering a high speed jet, something like the one that powered the recently concluded Singles’ Day sale at Alibaba that notched the group a record-breaking $38 billion GMV sales.\r\nThe performance, reliability, and agility of the core ecommerce platform increased drastically after moving 100 percent on its public cloud. “We want to share Alibaba Group’s experience with our customers so that we can enable them to take their businesses to the next level,” he added.\r\n'),
(33, '2019-11-20 09:38:17', 'Defense intelligence report highlights Iran’s advances in space technology', 'Technology', 'Tom', 'f-iranrocket-a-20170729-840x485.jpg', 'The report titled ”Iran Military Power” is part of a Defense Intelligence Agency effort to inform government leaders and the public on major foreign military challenges.\r\nWASHINGTON — The Defense Intelligence Agency released a new unclassified report that highlights Iran’s space program as a means to advance that nation’s civilian and military technologies.\r\n\r\nThe report titled ”Iran Military Power” was released Nov. 19 as part of a DIA effort to inform government leaders and the public on major foreign military challenges facing the United States. It is the third in a series. ”Russia Military Power” came out in June 2017 and “China Military Power” in January 2019.\r\n\r\nA key concern for the Pentagon is Iran’s development of space rockets to test long-range missiles, said a defense intelligence official who briefed reporters Nov. 19 and asked to not be quoted by name.\r\n\r\n“We’re looking at their space program as we determine what could be used for military means,” the official said. DIA does not analyze what percentage of Iran’s program is civilian or military but the agency noted in the report that Iran “recognizes the strategic value of space and counterspace capabilities.”'),
(34, '2019-11-20 09:39:08', 'Quantum-technology programmes in UK, China and Russia are described by top physicists', 'Technology', 'Tom', 'quentum.jpg.jpg', '                    Quantum-technology initiatives in Russia, China and the UK are the subjects of three different articles in the journal Quantum Science and Technology, which has put together a special Focus on Quantum Science and Technology Initiatives Around the World.\r\n\r\n\r\nThe UK report is by Peter Knight and Ian Walmsley of Imperial College London and describes how more the £1bn in government and industry funding has been committed to developing quantum technologies in the period 2014-2024. The UK’s National Quantum Technology Programme and its research and skills hubs at universities throughout the country are also described.                  '),
(35, '2019-11-20 16:03:56', 'sangam', 'Business', 'Tom', 'cricket.png', 'sangam is student of amc sir'),
(36, '2019-11-20 16:05:51', 'asdft', 'food', 'Tom', '', 'sadfghjklkjhgffghjklkjhgfds');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `datetime`, `username`, `password`) VALUES
(1, '2019-11-15 09:03:32', 'Shanu', '$2y$10$oKQEJNjJoUELnl6fecdmnez5irt20J44Jnd6UZHBN/HbnsshUP1FG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Foreign_Relation` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
