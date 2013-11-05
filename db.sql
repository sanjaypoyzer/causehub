-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2013 at 01:14 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `causehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

CREATE TABLE IF NOT EXISTS `causes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `started` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(25) NOT NULL,
  `hidden` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `uid`, `name`, `slug`, `started`, `description`, `category`, `hidden`, `deleted`) VALUES
(1, 1, 'Ban fracking', 'ban-fracking', '06-10-2013', '{"data":[{"type":"heading","data":{"text":"First, [the basics](http://grist.org/basics/fracking\\\\-faq\\\\-the\\\\-science\\\\-and\\\\-technology\\\\-behind\\\\-the\\\\-natural\\\\-gas\\\\-boom/)."}},{"type":"text","data":{"text":"Fracking is a nickname for hydraulic fracturing. It is a process in which we enterprising humans pump special fluid a potion made of water, sand, and mysterious chemical additives deep into the ground, releasing natural gas and oil that is trapped in shale or sand. The gas was happy there. The rock layers were protecting it. But now it''s ours, all ours! Muahahaha.\\n\\nFans of fracking cite the fact that natural gas is cheap, abundant, and relatively clean\\\\-burning. The booming industry makes people feel happy about energy independence, creates jobs, and boosts local economies why, one pizza shop in South Dakota reportedly made $1 million after fracking came to town!\\n\\nBut there''s trouble in River City:\\n"}},{"type":"list","data":{"text":" - **Fracking can contaminate water.** Just ask the people in Dimock, Penn, where methane from gas wells apparently [contaminated household water](http://articles.philly.com/2012\\\\-08\\\\-27/news/33403570\\\\_1\\\\_susquehanna\\\\-county\\\\-town\\\\-cabot\\\\-oil\\\\-baby\\\\-drill). Or the people in Pavillion, Wyo, where drilling likely [polluted the town''s aquifer](http://www.propublica.org/article/epas\\\\-abandoned\\\\-wyoming\\\\-fracking\\\\-study\\\\-one\\\\-retreat\\\\-of\\\\-many). While this is a [hotly contested topic](http://www.bloomberg.com/news/2013\\\\-07\\\\-19/fracking\\\\-research\\\\-finding\\\\-no\\\\-water\\\\-taint\\\\-near\\\\-drill\\\\-site.html), one thing is certain: Homeowners near fracking sites are reporting water that smells bad, tastes bad, and makes their families sick. Stay tuned.\\n - **Fracking causes earthquakes.** Or rather, the injection of wastewater from the fracking process into the ground causes earthquakes. It has caused earthquakes in Ohio, Oklahoma, Arkansas, Texas, and other places. Recent research suggests it also makes earthquakes more likely here when major quakes strike across the globe. [Read this article](http://www.reuters.com/article/2013/07/11/us\\\\-science\\\\-fracking\\\\-earthquakes\\\\-idUSBRE96A0TZ20130711). Or enjoy the animated GIF\\\\-ery of [this one](http://www.motherjones.com/blue\\\\-marble/2013/07/earthquakes\\\\-triggered\\\\-more\\\\-earthquakes\\\\-near\\\\-us\\\\-fracking\\\\-sites).\\n - **Fracking pollutes the air and our bodies.** A [study](http://www.ucdenver.edu/about/newsroom/newsreleases/Pages/health\\\\-impacts\\\\-of\\\\-fracking\\\\-emissions.aspx) by the Colorado School of Public Health found that air near fracking sites contained carcinogens including benzene, posing possible health risks to nearby residents. People near wells have indeed complained of headaches, nausea, nosebleeds, breathing issues, and memory loss, and a [report](http://www.motherjones.com/blue\\\\-marble/2013/07/earthquakes\\\\-triggered\\\\-more\\\\-earthquakes\\\\-near\\\\-us\\\\-fracking\\\\-sites) from the Center for Environmental Health says proximity to the operations is particularly risky for pregnant women and young children. Want to know more? Here''s a painstakingly compiled list of [more than 1,500 people](http://pennsylvaniaallianceforcleanwaterandair.wordpress.com/the\\\\-list/) who have publicly discussed the impact of fracking on their lives.\\n - **Fracking finds nothing sacred.** The industry is super\\\\-cool with drilling [under parks](http://www.post\\\\-gazette.com/stories/local/region/allegheny\\\\-county\\\\-considers\\\\-drilling\\\\-beneath\\\\-parks\\\\-691481/), [next to playgrounds](http://m.shalereporter.com/industry/article\\\\_7d5d2d6a\\\\-63e6\\\\-11e2\\\\-852d\\\\-001a4bcf6878.html?mode=image), and [in cemeteries](http://www.cleveland.com/nation/index.ssf/2012/07/drilling\\\\_for\\\\_gas\\\\_in\\\\_cemeteries.html). Are you cool with that? Because they are cool with that. Listen, do you want your energy independence or not?!\\n"}},{"type":"video","data":{"source":"youtube","remote_id":"VHUMCGmjGsM"}},{"type":"video","data":{"source":"youtube","remote_id":"UlQsU4nI45k"}}]}', '', 0, 0),
(2, 1, 'Increase minimum wage for greenpeace', 'increase-wages', '06-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 0, 0),
(3, 1, 'Clear Greenpeace activists of piracy charges', '17439-test', '06-10-2013', '{"data":[{"type":"heading","data":{"text":"Header here"}},{"type":"text","data":{"text":"[Thi](http://google.com)s is the **content** gere\\n"}},{"type":"quote","data":{"text":"> **T**his is the quote","cite":"Jamie Davies"}},{"type":"video","data":{"source":"youtube","remote_id":"TNH_wAyaJzM"}},{"type":"video","data":{"source":"vimeo","remote_id":"62436242"}},{"type":"embedly","data":{"provider_url":"http://www.kickstarter.com/","description":"Jared Bouck is raising funds for Zcapture - Open Source 360 Product Photography on Kickstarter! Zcapture - 360Â° product photography hardware with powerful processing software.","title":"Zcapture - Open Source 360 Product Photography","author_name":"Jared Bouck","height":360,"thumbnail_width":640,"width":480,"html":"<iframe frameborder=\\"0\\" height=\\"360\\" scrolling=\\"no\\" src=\\"http://www.kickstarter.com/projects/jaredbouck/zcapture-open-source-360-product-photography-0/widget/video.html\\" width=\\"480\\" border=\\"0\\"></iframe>","author_url":"http://www.kickstarter.com/profile/jaredbouck","version":"1.0","provider_name":"Kickstarter","thumbnail_url":"https://s3.amazonaws.com/ksr/projects/691606/photo-main.jpg?1379984396","type":"rich","thumbnail_height":480}}]}', '', 0, 0),
(4, 1, 'Testing after rewire', '52291', '20-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 1),
(5, 1, 'test', '52863', '20-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 1),
(6, 1, 'another test', '70902', '20-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 1),
(7, 1, 'tesett', '23189', '20-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 1),
(8, 1, 'another test', '13021', '20-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 1),
(9, 1, 'TEESTTINNG', '57214ddd', '21-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(10, 1, 'Test Cause', '84141', '21-10-2013', '{"data":[{"type":"heading","data":{"text":"This is a heading"}},{"type":"text","data":{"text":"Text content here gjapsdjgfp askdof akpsdfk apsodfkpsdofk aposdkf pasodkfp aosdkf pasodk fpaosdkf poasdkfp aosdkfp askdpfa ksdpfoka psdfkas dpfoksdpf kasdpfk apsdkfp aoskdfpa ksdpfkas asd fpaosdfk pasodkf oapskdfp aspdfkp.\\n"}},{"type":"video","data":{"source":"youtube","remote_id":"quh0urSN84Q"}},{"type":"text","data":{"text":"_te_**st**\\n"}},{"type":"list","data":{"text":" - Line 1\\n - Line 2\\n - Line 3\\n"}},{"type":"embedly","data":{"provider_url":"http://www.kickstarter.com/","description":"Rebecca Dmytryk is raising funds for WildHelp on Kickstarter! Find help for an injured animal, fast! This app will connect users with the nearest rescuers, based on GPS and type of animal found.","title":"WildHelp","author_name":"Rebecca Dmytryk","height":360,"thumbnail_width":640,"width":480,"html":"<iframe frameborder=\\"0\\" height=\\"360\\" scrolling=\\"no\\" src=\\"http://www.kickstarter.com/projects/wildhelp/wildhelp/widget/video.html\\" width=\\"480\\" border=\\"0\\"></iframe>","author_url":"http://www.kickstarter.com/profile/wildhelp","version":"1.0","provider_name":"Kickstarter","thumbnail_url":"https://s3.amazonaws.com/ksr/projects/690690/photo-main.jpg?1379942050","type":"rich","thumbnail_height":480}},{"type":"embedly","data":{"provider_url":"http://placehold.it","url":"http://placehold.it/350x150","height":150,"width":350,"version":"1.0","provider_name":"Placehold","type":"photo"}}]}', '', 0, 0),
(11, 1, 'Test with new desc', '13994', '21-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(12, 1, 'Fresh Project', '94679', '22-10-2013', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(125) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(25) NOT NULL,
  `timedate` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kb_action_hostevent`
--

CREATE TABLE IF NOT EXISTS `kb_action_hostevent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `url` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kb_action_lobbylord`
--

CREATE TABLE IF NOT EXISTS `kb_action_lobbylord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kb_action_lobbymedia`
--

CREATE TABLE IF NOT EXISTS `kb_action_lobbymedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kb_action_lobbymp`
--

CREATE TABLE IF NOT EXISTS `kb_action_lobbymp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kb_action_lobbymp`
--

INSERT INTO `kb_action_lobbymp` (`id`, `name`, `address`, `message`) VALUES
(1, 'Mike Weatherley', 'mike@mikeweatherleymp.com', 'hey man fracking is bad ok'),
(2, 'philip davies', 'ageajn@garv.com', 'alkjdfaowieasdkjnaeowefn');

-- --------------------------------------------------------

--
-- Table structure for table `kb_action_petitions`
--

CREATE TABLE IF NOT EXISTS `kb_action_petitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `knowledgebase`
--

CREATE TABLE IF NOT EXISTS `knowledgebase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `fact` varchar(140) NOT NULL,
  `source` varchar(150) NOT NULL,
  `sourcetitle` varchar(50) NOT NULL,
  `discussionid` int(11) NOT NULL,
  `action` varchar(15) NOT NULL,
  `actionid` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `knowledgebase`
--

INSERT INTO `knowledgebase` (`id`, `cid`, `fact`, `source`, `sourcetitle`, `discussionid`, `action`, `actionid`, `deleted`) VALUES
(1, 1, 'MP for Brighton criticisizes fracking protestors', 'http://www.brightonandhovenews.org/2013/08/20/hove-mp-criticises-fracking-protesters/23294', 'News', 1, 'lobbyMP', 1, 0),
(2, 2, 'conversative mp thinks minimum wage is too high ', 'http://www.bbc.co.uk/news/uk-politics-13809620', 'News', 1, 'lobbyMP', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `petition_signatures`
--

CREATE TABLE IF NOT EXISTS `petition_signatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `timedate` varchar(30) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `sid` varchar(10) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `path` text NOT NULL,
  `timedate` varchar(25) NOT NULL,
  `killed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fname`, `lname`) VALUES
(1, 'viralpickaxe', '1a1dc91c907325c69271ddf0c944bc72', 'viralpickaxe@gmail.com', 'Jamie', 'Davies'),
(2, 'sanjaypoyzer', '1a1dc91c907325c69271ddf0c944bc72', 'sanjaypoyzer@gmail.com', 'Sanjay', 'Poyzer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
