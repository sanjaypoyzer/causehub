-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2013 at 01:59 PM
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
-- Table structure for table `actionbase`
--

CREATE TABLE IF NOT EXISTS `actionbase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `action` varchar(15) NOT NULL,
  `actionid` int(11) NOT NULL,
  `timedate` varchar(25) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `actionbase`
--

INSERT INTO `actionbase` (`id`, `cid`, `action`, `actionid`, `timedate`, `deleted`) VALUES
(1, 23, 'petition', 1, '13:23:31 16-11-2013', 0),
(2, 23, 'event', 1, '13:24:21 16-11-2013', 0),
(3, 23, 'petition', 2, '13:25:46 16-11-2013', 0),
(4, 23, 'petition', 3, '13:38:52 16-11-2013', 0),
(5, 23, 'event', 2, '13:40:14 16-11-2013', 0);

-- --------------------------------------------------------

--
-- Table structure for table `action_event`
--

CREATE TABLE IF NOT EXISTS `action_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atext` varchar(150) NOT NULL,
  `link` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `action_event`
--

INSERT INTO `action_event` (`id`, `atext`, `link`) VALUES
(1, 'Host an Event', 'http://event-this.org'),
(2, 'Test content', 'http://example.com');

-- --------------------------------------------------------

--
-- Table structure for table `action_other`
--

CREATE TABLE IF NOT EXISTS `action_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atext` varchar(150) NOT NULL,
  `link` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `action_petition`
--

CREATE TABLE IF NOT EXISTS `action_petition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atext` varchar(150) NOT NULL,
  `link` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `action_petition`
--

INSERT INTO `action_petition` (`id`, `atext`, `link`) VALUES
(1, 'Sign this Petition', 'http://petitionhere.org'),
(2, 'Sign this Petition For Saving Lived', 'http://anotherpetition.org'),
(3, 'Sign this Petitiondasd', 'http://google.com');

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
  `banner` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `hidden` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `uid`, `name`, `slug`, `started`, `banner`, `description`, `tags`, `hidden`, `deleted`) VALUES
(1, 1, 'Ban fracking', 'ban-fracking', '06-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"First, [the basics](http://grist.org/basics/fracking\\\\-faq\\\\-the\\\\-science\\\\-and\\\\-technology\\\\-behind\\\\-the\\\\-natural\\\\-gas\\\\-boom/)."}},{"type":"text","data":{"text":"Fracking is a nickname for hydraulic fracturing. It is a process in which we enterprising humans pump special fluid a potion made of water, sand, and mysterious chemical additives deep into the ground, releasing natural gas and oil that is trapped in shale or sand. The gas was happy there. The rock layers were protecting it. But now it''s ours, all ours! Muahahaha.\\n\\nFans of fracking cite the fact that natural gas is cheap, abundant, and relatively clean\\\\-burning. The booming industry makes people feel happy about energy independence, creates jobs, and boosts local economies why, one pizza shop in South Dakota reportedly made $1 million after fracking came to town!\\n\\nBut there''s trouble in River City:\\n"}},{"type":"list","data":{"text":" - **Fracking can contaminate water.** Just ask the people in Dimock, Penn, where methane from gas wells apparently [contaminated household water](http://articles.philly.com/2012\\\\-08\\\\-27/news/33403570\\\\_1\\\\_susquehanna\\\\-county\\\\-town\\\\-cabot\\\\-oil\\\\-baby\\\\-drill). Or the people in Pavillion, Wyo, where drilling likely [polluted the town''s aquifer](http://www.propublica.org/article/epas\\\\-abandoned\\\\-wyoming\\\\-fracking\\\\-study\\\\-one\\\\-retreat\\\\-of\\\\-many). While this is a [hotly contested topic](http://www.bloomberg.com/news/2013\\\\-07\\\\-19/fracking\\\\-research\\\\-finding\\\\-no\\\\-water\\\\-taint\\\\-near\\\\-drill\\\\-site.html), one thing is certain: Homeowners near fracking sites are reporting water that smells bad, tastes bad, and makes their families sick. Stay tuned.\\n - **Fracking causes earthquakes.** Or rather, the injection of wastewater from the fracking process into the ground causes earthquakes. It has caused earthquakes in Ohio, Oklahoma, Arkansas, Texas, and other places. Recent research suggests it also makes earthquakes more likely here when major quakes strike across the globe. [Read this article](http://www.reuters.com/article/2013/07/11/us\\\\-science\\\\-fracking\\\\-earthquakes\\\\-idUSBRE96A0TZ20130711). Or enjoy the animated GIF\\\\-ery of [this one](http://www.motherjones.com/blue\\\\-marble/2013/07/earthquakes\\\\-triggered\\\\-more\\\\-earthquakes\\\\-near\\\\-us\\\\-fracking\\\\-sites).\\n - **Fracking pollutes the air and our bodies.** A [study](http://www.ucdenver.edu/about/newsroom/newsreleases/Pages/health\\\\-impacts\\\\-of\\\\-fracking\\\\-emissions.aspx) by the Colorado School of Public Health found that air near fracking sites contained carcinogens including benzene, posing possible health risks to nearby residents. People near wells have indeed complained of headaches, nausea, nosebleeds, breathing issues, and memory loss, and a [report](http://www.motherjones.com/blue\\\\-marble/2013/07/earthquakes\\\\-triggered\\\\-more\\\\-earthquakes\\\\-near\\\\-us\\\\-fracking\\\\-sites) from the Center for Environmental Health says proximity to the operations is particularly risky for pregnant women and young children. Want to know more? Here''s a painstakingly compiled list of [more than 1,500 people](http://pennsylvaniaallianceforcleanwaterandair.wordpress.com/the\\\\-list/) who have publicly discussed the impact of fracking on their lives.\\n - **Fracking finds nothing sacred.** The industry is super\\\\-cool with drilling [under parks](http://www.post\\\\-gazette.com/stories/local/region/allegheny\\\\-county\\\\-considers\\\\-drilling\\\\-beneath\\\\-parks\\\\-691481/), [next to playgrounds](http://m.shalereporter.com/industry/article\\\\_7d5d2d6a\\\\-63e6\\\\-11e2\\\\-852d\\\\-001a4bcf6878.html?mode=image), and [in cemeteries](http://www.cleveland.com/nation/index.ssf/2012/07/drilling\\\\_for\\\\_gas\\\\_in\\\\_cemeteries.html). Are you cool with that? Because they are cool with that. Listen, do you want your energy independence or not?!\\n"}},{"type":"video","data":{"source":"youtube","remote_id":"VHUMCGmjGsM"}},{"type":"video","data":{"source":"youtube","remote_id":"UlQsU4nI45k"}}]}', '', 0, 0),
(2, 1, 'Increase minimum wage for greenpeace', 'increase-wages', '06-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 0, 0),
(3, 1, 'Clear Greenpeace activists of piracy charges', '17439-test', '06-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"Header here"}},{"type":"text","data":{"text":"[Thi](http://google.com)s is the **content** gere\\n"}},{"type":"quote","data":{"text":"> **T**his is the quote","cite":"Jamie Davies"}},{"type":"video","data":{"source":"youtube","remote_id":"TNH_wAyaJzM"}},{"type":"video","data":{"source":"vimeo","remote_id":"62436242"}},{"type":"embedly","data":{"provider_url":"http://www.kickstarter.com/","description":"Jared Bouck is raising funds for Zcapture - Open Source 360 Product Photography on Kickstarter! Zcapture - 360Â° product photography hardware with powerful processing software.","title":"Zcapture - Open Source 360 Product Photography","author_name":"Jared Bouck","height":360,"thumbnail_width":640,"width":480,"html":"<iframe frameborder=\\"0\\" height=\\"360\\" scrolling=\\"no\\" src=\\"http://www.kickstarter.com/projects/jaredbouck/zcapture-open-source-360-product-photography-0/widget/video.html\\" width=\\"480\\" border=\\"0\\"></iframe>","author_url":"http://www.kickstarter.com/profile/jaredbouck","version":"1.0","provider_name":"Kickstarter","thumbnail_url":"https://s3.amazonaws.com/ksr/projects/691606/photo-main.jpg?1379984396","type":"rich","thumbnail_height":480}}]}', 'das,dass,test,green,peace', 0, 0),
(4, 1, 'Testing after rewire', '52291', '20-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', 'tolo', 0, 1),
(5, 1, 'test', '52863', '20-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', 'test,tag', 0, 1),
(6, 1, 'another test', '70902', '20-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', 'anoeth,thing', 0, 1),
(7, 1, 'tesett', '23189', '20-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', 'holla,yolo', 0, 1),
(8, 1, 'another test', '13021', '20-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 1),
(9, 1, 'TEESTTINNG', '57214ddd', '21-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(10, 2, 'Test Cause', '84141', '21-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is a heading"}},{"type":"text","data":{"text":"Text content here gjapsdjgfp askdof akpsdfk apsodfkpsdofk aposdkf pasodkfp aosdkf pasodk fpaosdkf poasdkfp aosdkfp askdpfa ksdpfoka psdfkas dpfoksdpf kasdpfk apsdkfp aoskdfpa ksdpfkas asd fpaosdfk pasodkf oapskdfp aspdfkp.\\n"}},{"type":"video","data":{"source":"youtube","remote_id":"quh0urSN84Q"}},{"type":"text","data":{"text":"_te_**st**\\n"}},{"type":"list","data":{"text":" - Line 1\\n - Line 2\\n - Line 3\\n"}},{"type":"embedly","data":{"provider_url":"http://www.kickstarter.com/","description":"Rebecca Dmytryk is raising funds for WildHelp on Kickstarter! Find help for an injured animal, fast! This app will connect users with the nearest rescuers, based on GPS and type of animal found.","title":"WildHelp","author_name":"Rebecca Dmytryk","height":360,"thumbnail_width":640,"width":480,"html":"<iframe frameborder=\\"0\\" height=\\"360\\" scrolling=\\"no\\" src=\\"http://www.kickstarter.com/projects/wildhelp/wildhelp/widget/video.html\\" width=\\"480\\" border=\\"0\\"></iframe>","author_url":"http://www.kickstarter.com/profile/wildhelp","version":"1.0","provider_name":"Kickstarter","thumbnail_url":"https://s3.amazonaws.com/ksr/projects/690690/photo-main.jpg?1379942050","type":"rich","thumbnail_height":480}},{"type":"embedly","data":{"provider_url":"http://placehold.it","url":"http://placehold.it/350x150","height":150,"width":350,"version":"1.0","provider_name":"Placehold","type":"photo"}}]}', 'test,tag,here,yolo,dasfadsf', 0, 0),
(11, 1, 'Test with new desc', '13994', '21-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(12, 1, 'Fresh Project', '94679', '22-10-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(13, 1, 'Test creating cause', '12026', '05-11-2013', 'placehold.gif', '', '', 1, 0),
(14, 1, 'Another test create', 'test', '05-11-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(15, 1, 'Test bug fix', '60539', '06-11-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(16, 1, 'Another after bug test', '67461', '06-11-2013', 'placehold.gif', '{"data":[{"type":"text","data":{"text":"g"}}]}', '', 1, 0),
(17, 1, 'Build a house', '37443', '06-11-2013', 'nwt5frya0c.png', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"video","data":{"source":"youtube","remote_id":"-fk75e0IFUc"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', 'test,tag,here', 1, 1),
(18, 1, 'test empty', '73275', '06-11-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(19, 1, 'Test new cause create', '67598', '07-11-2013', 'placehold.gif', '{"data":[{"type":"heading","data":{"text":"This is your cause''s description"}},{"type":"text","data":{"text":"You use the cause description to tell other users about why they should help and support your cause.\\n\\nCreating and adding blocks to your description is very easy and there are 6 types of data you can add.\\n\\n**Once you have added and edited the blocks you want, you need to remember to press Update before you view the cause for it to save.**\\n"}},{"type":"list","data":{"text":" - Heading \\\\- Used to create section headers to seperate content/paragraphs\\n - Text \\\\- Used to display text, supports **BOLD**, _ITALIC_ and [HYPERLINKS](http://causehub.co)\\n - Quote \\\\- Used to add quotes to description. Supports Bold, Italics and hyperlinks\\n - List \\\\- Used to create bullet point lists \\\\(like this\\\\)\\n - Video \\\\- Used to add Youtube and Vimeo videos straight on the page \\\\(just paste the video url\\\\)\\n - Embedly \\\\- Used to insert images and some other content \\\\(Recommend to use manly image url''s\\\\)\\n"}},{"type":"quote","data":{"text":"> \\"Start promoting your cause today!\\"","cite":"CauseHub"}}]}', '', 1, 0),
(20, 2, 'test', '60993', '12-11-2013', 'placehold.gif', '{"data":[{"type":"text","data":{"text":"This is your cause''s description"}}]}', 'jll,kokok,[lpkoij,jllk,lllll,lll;k', 1, 0),
(21, 1, 'milo', 'esd', '13-11-2013', 'placehold.gif', '{"data":[{"type":"text","data":{"text":"This is your cause''s description. To add other elements press the + buttons above or below this."}}]}', 'yes,man,test,yolo', 0, 0),
(22, 1, 'Getting Tom The Help He Needs', 'getting-tom-the-help-he-needs', '13-11-2013', 'wchwq61faq.png', '{"data":[{"type":"text","data":{"text":"This is your cause''s description. To add other elements press the + buttons above or below this. yay\\n"}}]}', 'this,is,some,bad,test,data', 0, 0),
(23, 1, 'yaya', 'yaya', '16-11-2013', 'placehold.gif', '{"data":[{"type":"text","data":{"text":"This is your cause''s description. To add other elements press the + buttons above or below this.dd\\n"}}]}', 'some,tags,here', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `ip`, `timedate`) VALUES
(1, 'Jamie Davies', 'viralpickaxe@gmail.com', 'Really cool site, would be alot better if you could upload a custom image to your cause.', '::1', '13:17:49 05-11-2013'),
(2, 'Jamie', 'jda@das.com', 'Just testing after reduction', '::1', '13:45:09 07-11-2013');

-- --------------------------------------------------------

--
-- Table structure for table `passreset`
--

CREATE TABLE IF NOT EXISTS `passreset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `resetcode` varchar(15) NOT NULL,
  `timedate_created` varchar(25) NOT NULL,
  `timedate_used` varchar(25) NOT NULL,
  `ip` varchar(24) NOT NULL,
  `valid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `passreset`
--

INSERT INTO `passreset` (`id`, `uid`, `resetcode`, `timedate_created`, `timedate_used`, `ip`, `valid`) VALUES
(1, 1, '720pwjbpppb0gba', '13:10:18 11-11-2013', '', '::1', 0),
(2, 1, 'adqnqc9droq79qy', '13:13:02 11-11-2013', '', '::1', 0),
(3, 1, 'qrzhqtqdens6iqs', '13:20:19 11-11-2013', '13:51:30 11-11-2013', '::1', 0),
(4, 1, '3c89bk6lkqm97nt', '14:14:16 11-11-2013', '', '::1', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `petition_signatures`
--

INSERT INTO `petition_signatures` (`id`, `pid`, `fname`, `lname`, `email`, `timedate`, `ip`) VALUES
(1, 1, 'Jamie', 'Davies', 'viral', '13:28:34 07-11-2013', '::1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `uid`, `sid`, `ip`, `path`, `timedate`, `killed`) VALUES
(1, 1, 'g1qgd5660c', '::1', 'a:25:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-04 09:57:56";}i:1;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-04 09:58:53";}i:2;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-04 09:58:54";}i:3;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-04 14:41:30";}i:4;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-04 14:42:26";}i:5;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-04 14:44:01";}i:6;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-04 14:44:08";}i:7;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-04 14:44:16";}i:8;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-05 08:43:01";}i:9;a:2:{s:3:"uri";s:18:"/cause/17439-test/";s:8:"timedate";s:19:"2013-11-05 08:47:10";}i:10;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-05 08:47:25";}i:11;a:2:{s:3:"uri";s:18:"/cause/17439-test/";s:8:"timedate";s:19:"2013-11-05 09:03:14";}i:12;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-05 09:03:36";}i:13;a:2:{s:3:"uri";s:11:"/getmps.php";s:8:"timedate";s:19:"2013-11-05 09:06:44";}i:14;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-05 09:20:43";}i:15;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-05 13:38:43";}i:16;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-05 13:38:44";}i:17;a:2:{s:3:"uri";s:17:"/editcause/12026/";s:8:"timedate";s:19:"2013-11-05 13:39:10";}i:18;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-05 13:40:02";}i:19;a:2:{s:3:"uri";s:17:"/editcause/95759/";s:8:"timedate";s:19:"2013-11-05 13:40:30";}i:20;a:2:{s:3:"uri";s:16:"/editcause/test/";s:8:"timedate";s:19:"2013-11-05 13:40:44";}i:21;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 08:15:34";}i:22;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-06 08:15:44";}i:23;a:2:{s:3:"uri";s:9:"/infohub/";s:8:"timedate";s:19:"2013-11-06 08:18:00";}i:24;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 08:19:09";}}', '13:38:43 05-11-2013', 1),
(2, 1, 'w1d3ss2o3g', '::1', 'a:38:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-06 09:15:31";}i:1;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 09:15:32";}i:2;a:2:{s:3:"uri";s:17:"/editcause/60539/";s:8:"timedate";s:19:"2013-11-06 09:15:48";}i:3;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 09:24:07";}i:4;a:2:{s:3:"uri";s:17:"/editcause/67461/";s:8:"timedate";s:19:"2013-11-06 09:24:46";}i:5;a:2:{s:3:"uri";s:13:"/cause/67461/";s:8:"timedate";s:19:"2013-11-06 09:40:13";}i:6;a:2:{s:3:"uri";s:17:"/editcause/67461/";s:8:"timedate";s:19:"2013-11-06 09:40:15";}i:7;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 13:09:30";}i:8;a:2:{s:3:"uri";s:17:"/editcause/67461/";s:8:"timedate";s:19:"2013-11-06 13:27:31";}i:9;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 13:34:02";}i:10;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 13:34:38";}i:11;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 13:35:22";}i:12;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 13:35:30";}i:13;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 13:35:44";}i:14;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 13:40:49";}i:15;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 13:44:02";}i:16;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 13:45:51";}i:17;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 14:15:46";}i:18;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 14:17:53";}i:19;a:2:{s:3:"uri";s:3:"/?1";s:8:"timedate";s:19:"2013-11-06 14:19:11";}i:20;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 14:21:07";}i:21;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 14:21:12";}i:22;a:2:{s:3:"uri";s:2:"/?";s:8:"timedate";s:19:"2013-11-06 14:21:25";}i:23;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 14:34:37";}i:24;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 14:34:42";}i:25;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 14:38:50";}i:26;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 14:38:53";}i:27;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 14:38:58";}i:28;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 14:39:14";}i:29;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 14:42:56";}i:30;a:2:{s:3:"uri";s:17:"/editcause/73275/";s:8:"timedate";s:19:"2013-11-06 14:43:11";}i:31;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 14:44:07";}i:32;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 15:51:03";}i:33;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 15:53:52";}i:34;a:2:{s:3:"uri";s:19:"/editcause/37443/?i";s:8:"timedate";s:19:"2013-11-06 15:56:10";}i:35;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-06 15:57:23";}i:36;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-06 16:00:28";}i:37;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-06 17:58:59";}}', '09:15:31 06-11-2013', 0),
(3, 1, 'ys7zuqq31f', '::1', 'a:11:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-07 13:13:16";}i:1;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-07 13:13:17";}i:2;a:2:{s:3:"uri";s:17:"/editcause/67598/";s:8:"timedate";s:19:"2013-11-07 13:14:15";}i:3;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-07 13:20:02";}i:4;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-07 13:27:36";}i:5;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-07 13:27:41";}i:6;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-07 13:28:19";}i:7;a:2:{s:3:"uri";s:16:"/petition/66343/";s:8:"timedate";s:19:"2013-11-07 13:28:25";}i:8;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-07 13:28:43";}i:9;a:2:{s:3:"uri";s:16:"/petition/66343/";s:8:"timedate";s:19:"2013-11-07 13:28:47";}i:10;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-07 13:30:20";}}', '13:13:16 07-11-2013', 1),
(4, 1, 'od9kneflva', '::1', 'a:2:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-07 14:53:32";}i:1;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-07 14:53:33";}}', '14:53:32 07-11-2013', 0),
(5, 1, 'cqn15qmd0f', '::1', 'a:2:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-11 13:51:42";}i:1;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-11 13:51:44";}}', '13:51:42 11-11-2013', 1),
(6, 1, 'y1pzj6sn4v', '::1', 'a:46:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-11 22:00:40";}i:1;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-11 22:00:41";}i:2;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-11 22:00:54";}i:3;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-11 22:00:59";}i:4;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-12 08:58:38";}i:5;a:2:{s:3:"uri";s:17:"/editcause/60993/";s:8:"timedate";s:19:"2013-11-12 11:55:39";}i:6;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-13 09:24:10";}i:7;a:2:{s:3:"uri";s:13:"/cause/37443/";s:8:"timedate";s:19:"2013-11-13 09:41:46";}i:8;a:2:{s:3:"uri";s:17:"/editcause/37443/";s:8:"timedate";s:19:"2013-11-13 09:42:05";}i:9;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-13 15:18:18";}i:10;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-13 15:20:36";}i:11;a:2:{s:3:"uri";s:17:"/editcause/84141/";s:8:"timedate";s:19:"2013-11-13 15:20:52";}i:12;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-13 15:52:24";}i:13;a:2:{s:3:"uri";s:41:"/editcause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-13 15:54:34";}i:14;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-14 09:06:47";}i:15;a:2:{s:3:"uri";s:18:"/cause/17439-test/";s:8:"timedate";s:19:"2013-11-14 09:06:51";}i:16;a:2:{s:3:"uri";s:22:"/editcause/17439-test/";s:8:"timedate";s:19:"2013-11-14 09:06:57";}i:17;a:2:{s:3:"uri";s:18:"/cause/17439-test/";s:8:"timedate";s:19:"2013-11-14 09:07:29";}i:18;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-14 09:21:50";}i:19;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-14 10:25:23";}i:20;a:2:{s:3:"uri";s:17:"/editcause/84141/";s:8:"timedate";s:19:"2013-11-14 10:25:41";}i:21;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-14 10:26:09";}i:22;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-14 10:53:42";}i:23;a:2:{s:3:"uri";s:18:"/cause/17439-test/";s:8:"timedate";s:19:"2013-11-14 13:31:08";}i:24;a:2:{s:3:"uri";s:22:"/editcause/17439-test/";s:8:"timedate";s:19:"2013-11-14 13:31:38";}i:25;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-14 13:37:00";}i:26;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-14 13:40:35";}i:27;a:2:{s:3:"uri";s:17:"/editcause/84141/";s:8:"timedate";s:19:"2013-11-14 13:41:39";}i:28;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-14 13:42:04";}i:29;a:2:{s:3:"uri";s:17:"/editcause/84141/";s:8:"timedate";s:19:"2013-11-14 13:42:46";}i:30;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-14 13:45:23";}i:31;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-14 17:45:27";}i:32;a:2:{s:3:"uri";s:37:"/cause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:09:06";}i:33;a:2:{s:3:"uri";s:41:"/editcause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:09:10";}i:34;a:2:{s:3:"uri";s:37:"/cause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:10:16";}i:35;a:2:{s:3:"uri";s:41:"/editcause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:10:21";}i:36;a:2:{s:3:"uri";s:37:"/cause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:13:39";}i:37;a:2:{s:3:"uri";s:41:"/editcause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:13:45";}i:38;a:2:{s:3:"uri";s:37:"/cause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:14:34";}i:39;a:2:{s:3:"uri";s:41:"/editcause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:14:47";}i:40;a:2:{s:3:"uri";s:37:"/cause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:15:06";}i:41;a:2:{s:3:"uri";s:41:"/editcause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-14 18:15:11";}i:42;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-14 18:15:28";}i:43;a:2:{s:3:"uri";s:11:"/cause/esd/";s:8:"timedate";s:19:"2013-11-14 18:15:33";}i:44;a:2:{s:3:"uri";s:15:"/editcause/esd/";s:8:"timedate";s:19:"2013-11-14 18:15:38";}i:45;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-16 11:08:30";}}', '22:00:40 11-11-2013', 1),
(7, 1, 'n7bfi3myb5', '::1', 'a:1:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-16 11:08:46";}}', '11:08:46 16-11-2013', 0),
(8, 1, 'gdokdepaec', '::1', 'a:1:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-16 11:11:29";}}', '11:11:29 16-11-2013', 0),
(9, 1, '6ueqbuivwj', '::1', 'a:2:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-16 11:11:29";}i:1;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-16 11:12:19";}}', '11:12:19 16-11-2013', 0),
(10, 1, 'ausdrp5sae', '::1', '', '11:14:42 16-11-2013', 0),
(11, 1, 'hn89k6253y', '::1', 'a:30:{i:0;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-16 11:11:29";}i:1;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-16 11:12:19";}i:2;a:2:{s:3:"uri";s:18:"login.entry.script";s:8:"timedate";s:19:"2013-11-16 11:15:43";}i:3;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-16 11:15:44";}i:4;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-16 11:39:46";}i:5;a:2:{s:3:"uri";s:17:"/editcause/84141/";s:8:"timedate";s:19:"2013-11-16 11:39:51";}i:6;a:2:{s:3:"uri";s:13:"/cause/84141/";s:8:"timedate";s:19:"2013-11-16 11:40:09";}i:7;a:2:{s:3:"uri";s:17:"/editcause/84141/";s:8:"timedate";s:19:"2013-11-16 11:40:14";}i:8;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-16 11:40:36";}i:9;a:2:{s:3:"uri";s:16:"/editcause/yaya/";s:8:"timedate";s:19:"2013-11-16 11:40:44";}i:10;a:2:{s:3:"uri";s:12:"/cause/yaya/";s:8:"timedate";s:19:"2013-11-16 11:41:01";}i:11;a:2:{s:3:"uri";s:16:"/editcause/yaya/";s:8:"timedate";s:19:"2013-11-16 11:41:03";}i:12;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-16 11:54:37";}i:13;a:2:{s:3:"uri";s:6:"/dash/";s:8:"timedate";s:19:"2013-11-16 11:58:05";}i:14;a:2:{s:3:"uri";s:16:"/editcause/yaya/";s:8:"timedate";s:19:"2013-11-16 11:58:09";}i:15;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-16 13:47:30";}i:16;a:2:{s:3:"uri";s:37:"/cause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-16 13:47:34";}i:17;a:2:{s:3:"uri";s:41:"/editcause/getting-tom-the-help-he-needs/";s:8:"timedate";s:19:"2013-11-16 13:47:58";}i:18;a:2:{s:3:"uri";s:6:"/dash/";s:8:"timedate";s:19:"2013-11-16 13:48:03";}i:19;a:2:{s:3:"uri";s:12:"/cause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:48:07";}i:20;a:2:{s:3:"uri";s:16:"/editcause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:48:09";}i:21;a:2:{s:3:"uri";s:12:"/cause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:48:33";}i:22;a:2:{s:3:"uri";s:16:"/editcause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:48:42";}i:23;a:2:{s:3:"uri";s:12:"/cause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:48:51";}i:24;a:2:{s:3:"uri";s:16:"/editcause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:49:31";}i:25;a:2:{s:3:"uri";s:12:"/cause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:49:42";}i:26;a:2:{s:3:"uri";s:16:"/editcause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:50:01";}i:27;a:2:{s:3:"uri";s:12:"/cause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:50:16";}i:28;a:2:{s:3:"uri";s:1:"/";s:8:"timedate";s:19:"2013-11-16 13:50:20";}i:29;a:2:{s:3:"uri";s:12:"/cause/yaya/";s:8:"timedate";s:19:"2013-11-16 13:50:32";}}', '11:15:43 16-11-2013', 0);

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
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fname`, `lname`, `admin`) VALUES
(1, 'viralpickaxe', '1a1dc91c907325c69271ddf0c944bc72', 'viralpickaxe@gmail.com', 'Jamie', 'Davies', 1),
(2, 'sanjaypoyzer', '1a1dc91c907325c69271ddf0c944bc72', 'sanjaypoyzer@gmail.com', 'Sanjay', 'Poyzer', 1),
(3, 'jerome', '47f064d8edfe525d223cd7f987ef8f4c', 'jerometoole@gmail.com', 'Jerome', 'Toole', 1),
(4, 'tuser', '1a1dc91c907325c69271ddf0c944bc72', 'jamieis10@googlemail.com', 'Test', 'User', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
