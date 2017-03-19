CREATE TABLE IF NOT EXISTS `wp_ns_aboutfields` (
  `aboutfield_id` bigint(20) UNSIGNED NOT NULL,
  `aboutfield_position` int(11) NOT NULL,
  `aboutfield_name` varchar(100) NOT NULL,
  `aboutfield_type` enum('ABOUTFIELD_TYPE_STRING','ABOUTFIELD_TYPE_INT','ABOUTFIELD_TYPE_POSTID') NOT NULL,
  `aboutfield_stringvalue` varchar(5000) DEFAULT '',
  `aboutfield_intvalue` bigint(20) DEFAULT NULL,
  `aboutfield_post_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_achievements` (
  `achv_id` bigint(20) UNSIGNED NOT NULL,
  `achv_position` int(11) NOT NULL,
  `achv_abbr` varchar(50) NOT NULL,
  `achv_desc` varchar(500) NOT NULL,
  `achv_post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_awards` (
  `award_id` bigint(20) UNSIGNED NOT NULL,
  `award_title` varchar(500) NOT NULL,
  `award_abbr` varchar(50) NOT NULL,
  `award_source` varchar(500) NOT NULL,
  `award_sourceurl` varchar(500) NOT NULL,
  `award_date` date NOT NULL,
  `award_reason` varchar(500) NOT NULL,
  `award_reasonurl` varchar(500) NOT NULL,
  `award_post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_education` (
  `edu_id` bigint(20) UNSIGNED NOT NULL,
  `edu_degree` varchar(100) NOT NULL,
  `edu_college` varchar(200) NOT NULL,
  `edu_country` varchar(100) NOT NULL,
  `edu_url` varchar(200) NOT NULL,
  `edu_post_id` bigint(20) UNSIGNED NOT NULL,
  `edu_major` varchar(200) NOT NULL,
  `edu_minor` varchar(200) NOT NULL,
  `edu_begin` date NOT NULL,
  `edu_end` date NOT NULL,
  `edu_honors` varchar(200) NOT NULL,
  `edu_desc` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_gallery` (
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `gallery_name` varchar(100) NOT NULL,
  `gallery_desc` varchar(1000) NOT NULL,
  `gallery_post_id` bigint(20) UNSIGNED NOT NULL,
  `gallery_displayed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_gallery_posts` (
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_headermenu` (
  `headermenu_id` bigint(22) UNSIGNED NOT NULL,
  `headermenu_position` int(11) NOT NULL,
  `headermenu_title` varchar(30) NOT NULL,
  `headermenu_post_id` bigint(22) UNSIGNED DEFAULT NULL,
  `headermenu_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_headers` (
  `header_id` bigint(20) UNSIGNED NOT NULL,
  `header_position` int(11) NOT NULL,
  `header_post_id` bigint(20) UNSIGNED NOT NULL,
  `header_subtitle` varchar(200) NOT NULL,
  `header_desc` varchar(1000) NOT NULL,
  `header_page_post_id` bigint(22) UNSIGNED NOT NULL,
  `header_subtitlesize` int(11) NOT NULL DEFAULT '25',
  `header_h1color` varchar(100) NOT NULL,
  `header_h1shadow` varchar(100) NOT NULL,
  `header_h2color` varchar(100) NOT NULL,
  `header_h2shadow` varchar(100) NOT NULL,
  `header_abstractcolor` varchar(100) NOT NULL,
  `header_abstractshadow` varchar(100) NOT NULL,
  `header_menucolor` varchar(100) NOT NULL,
  `header_menushadow` varchar(100) NOT NULL,
  `header_menubordercolor` varchar(100) NOT NULL,
  `header_buttoncolor` varchar(100) NOT NULL,
  `header_buttontextcolor` varchar(100) NOT NULL,
  `header_imagesprefix` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_hobbies` (
  `hobby_id` bigint(20) UNSIGNED NOT NULL,
  `hobby_name` varchar(100) NOT NULL,
  `hobby_post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_home` (
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `home_position` int(11) NOT NULL,
  `home_type` enum('HOME_TYPE_CATEGORY','HOME_TYPE_FOLLOWME','HOME_TYPE_PUBLICATIONS','HOME_TYPE_PROJECTS','HOME_TYPE_POST_ID') NOT NULL,
  `home_color` enum('HOME_COLOR_WHITE','HOME_COLOR_LIGHTGREY','HOME_COLOR_DARKGREY') NOT NULL,
  `home_term_id` bigint(20) UNSIGNED DEFAULT NULL,
  `home_gallery_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_languages` (
  `lang_id` bigint(20) UNSIGNED NOT NULL,
  `lang_language` varchar(50) NOT NULL,
  `lang_level` enum('LANG_LEVEL_NONE','LANG_LEVEL_BEGINNER','LANG_LEVEL_INTERMEDIATE','LANG_LEVEL_ADVANCED','LANG_LEVEL_NATURAL') NOT NULL,
  `lang_desc` varchar(200) NOT NULL,
  `lang_post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_projects` (
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_desc` varchar(10000) NOT NULL,
  `project_shortdesc` varchar(200) NOT NULL,
  `project_post_id` bigint(20) UNSIGNED NOT NULL,
  `project_page_post_id` bigint(22) UNSIGNED NOT NULL,
  `project_background_post_id` bigint(20) UNSIGNED NOT NULL,
  `project_foreground_post_id` bigint(20) UNSIGNED NOT NULL,
  `project_gallery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_bmin` int(11) NOT NULL,
  `project_bmax` int(11) NOT NULL,
  `project_fmin` int(11) NOT NULL,
  `project_fmax` int(11) NOT NULL,
  `project_textcolor` varchar(100) NOT NULL,
  `project_buttontextcolor` varchar(50) NOT NULL,
  `project_line` enum('PROJECT_LINE_LIGHT','PROJECT_LINE_DARK') NOT NULL,
  `project_startdate` date NOT NULL,
  `project_enddate` date NOT NULL,
  `project_active` tinyint(1) NOT NULL DEFAULT '1',
  `project_todisplay` tinyint(1) NOT NULL DEFAULT '1',
  `project_externalurl` varchar(100) NOT NULL,
  `project_keywords` varchar(500) NOT NULL,
  `project_morecolor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_projects_terms` (
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_publications` (
  `pub_id` bigint(20) UNSIGNED NOT NULL,
  `pub_title` varchar(500) NOT NULL,
  `pub_authors` varchar(100) NOT NULL,
  `pub_abstract` varchar(5000) NOT NULL,
  `pub_date` date NOT NULL,
  `pub_url` varchar(1000) NOT NULL,
  `pub_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pub_keywords` varchar(1000) NOT NULL,
  `pub_type` enum('PUB_TYPE_CONFERENCE_PAPER','PUB_TYPE_JOURNAL_PAPER','PUB_TYPE_BOOK','PUB_TYPE_MASTER_THESIS','PUB_TYPE_PHD_THESIS','PUB_TYPE_POSTER') NOT NULL,
  `pub_publisher` varchar(100) NOT NULL,
  `pub_edition` varchar(50) NOT NULL,
  `pub_publisherlink` varchar(100) NOT NULL,
  `pub_publishercomp` varchar(500) NOT NULL,
  `pub_filetype` enum('PUB_FILETYPE_PDF','PUB_FILETYPE_HTML') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_publications_terms` (
  `pub_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_researches` (
  `research_id` bigint(20) UNSIGNED NOT NULL,
  `research_name` varchar(100) NOT NULL,
  `research_desc` varchar(10000) NOT NULL,
  `research_shortdesc` varchar(200) NOT NULL,
  `research_page_post_id` bigint(22) UNSIGNED NOT NULL,
  `research_gallery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `research_keywords` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_researches_terms` (
  `research_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_traits` (
  `trait_id` bigint(20) UNSIGNED NOT NULL,
  `trait_position` int(11) NOT NULL,
  `trait_name` varchar(100) NOT NULL,
  `trait_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trait_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wp_ns_workexp` (
  `workexp_id` bigint(20) UNSIGNED NOT NULL,
  `workexp_position` varchar(500) NOT NULL,
  `workexp_company` varchar(500) NOT NULL,
  `workexp_address` varchar(500) NOT NULL,
  `workexp_country` varchar(50) NOT NULL,
  `workexp_url` varchar(500) NOT NULL,
  `workexp_post_id` bigint(20) UNSIGNED NOT NULL,
  `workexp_honors` varchar(500) NOT NULL,
  `workexp_desc` varchar(1000) NOT NULL,
  `workexp_begin` date NOT NULL,
  `workexp_end` date NOT NULL,
  `workexp_duration` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `wp_ns_aboutfields`
  ADD PRIMARY KEY (`aboutfield_id`),
  ADD UNIQUE KEY `aboutfield_position` (`aboutfield_position`),
  ADD KEY `mid` (`aboutfield_post_id`);
  
ALTER TABLE `wp_ns_achievements`
  ADD PRIMARY KEY (`achv_id`),
  ADD UNIQUE KEY `achv_position` (`achv_position`),
  ADD KEY `mid` (`achv_post_id`);
  
ALTER TABLE `wp_ns_awards`
  ADD PRIMARY KEY (`award_id`),
  ADD KEY `mid` (`award_post_id`);
  
ALTER TABLE `wp_ns_education`
  ADD PRIMARY KEY (`edu_id`),
  ADD KEY `mid` (`edu_post_id`);
  
ALTER TABLE `wp_ns_gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `gallery_post_id` (`gallery_post_id`);
  
ALTER TABLE `wp_ns_gallery_posts`
  ADD PRIMARY KEY (`gallery_id`,`post_id`),
  ADD KEY `FK_GALLERYMEDIA_POSTID` (`post_id`),
  ADD KEY `gallery_id` (`gallery_id`,`post_id`);
  
ALTER TABLE `wp_ns_headermenu`
  ADD PRIMARY KEY (`headermenu_id`),
  ADD UNIQUE KEY `headermenu_title` (`headermenu_title`),
  ADD UNIQUE KEY `headermenu_position` (`headermenu_position`),
  ADD KEY `headermenu_post_id` (`headermenu_post_id`);
  
ALTER TABLE `wp_ns_headers`
  ADD PRIMARY KEY (`header_id`),
  ADD UNIQUE KEY `header_position` (`header_position`),
  ADD KEY `mid` (`header_post_id`),
  ADD KEY `header_post_id` (`header_post_id`),
  ADD KEY `header_page_post_id` (`header_page_post_id`);
  
ALTER TABLE `wp_ns_hobbies`
  ADD PRIMARY KEY (`hobby_id`),
  ADD KEY `mid` (`hobby_post_id`);
  
ALTER TABLE `wp_ns_home`
  ADD PRIMARY KEY (`home_id`),
  ADD UNIQUE KEY `position` (`home_position`),
  ADD KEY `term_id` (`home_term_id`),
  ADD KEY `home_gallery_id` (`home_gallery_id`);
  
ALTER TABLE `wp_ns_languages`
  ADD PRIMARY KEY (`lang_id`),
  ADD KEY `mid` (`lang_post_id`);
  
ALTER TABLE `wp_ns_projects`
  ADD PRIMARY KEY (`project_id`),
  ADD UNIQUE KEY `project_name` (`project_name`),
  ADD KEY `mid` (`project_post_id`),
  ADD KEY `project_background_post_id` (`project_background_post_id`),
  ADD KEY `project_foreground_post_id` (`project_foreground_post_id`),
  ADD KEY `project_gallery_id` (`project_gallery_id`),
  ADD KEY `project_page_post_id` (`project_page_post_id`);
  
ALTER TABLE `wp_ns_projects_terms`
  ADD PRIMARY KEY (`term_id`,`project_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `prid` (`project_id`);
  
ALTER TABLE `wp_ns_publications`
  ADD PRIMARY KEY (`pub_id`),
  ADD KEY `mid` (`pub_post_id`);
  
ALTER TABLE `wp_ns_publications_terms`
  ADD PRIMARY KEY (`pub_id`,`term_id`),
  ADD KEY `pub_id` (`pub_id`),
  ADD KEY `term_id` (`term_id`);
  
ALTER TABLE `wp_ns_researches`
  ADD PRIMARY KEY (`research_id`),
  ADD UNIQUE KEY `research_name` (`research_name`),
  ADD KEY `research_gallery_id` (`research_gallery_id`),
  ADD KEY `research_page_post_id` (`research_page_post_id`);
  
ALTER TABLE `wp_ns_researches_terms`
  ADD PRIMARY KEY (`term_id`,`research_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `rid` (`research_id`);
  
ALTER TABLE `wp_ns_traits`
  ADD PRIMARY KEY (`trait_id`),
  ADD UNIQUE KEY `position` (`trait_position`),
  ADD KEY `mid` (`trait_post_id`);
  
ALTER TABLE `wp_ns_workexp`
  ADD PRIMARY KEY (`workexp_id`),
  ADD KEY `mid` (`workexp_post_id`);
  
ALTER TABLE `wp_ns_aboutfields`
  MODIFY `aboutfield_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
  
ALTER TABLE `wp_ns_achievements`
  MODIFY `achv_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
  
ALTER TABLE `wp_ns_awards`
  MODIFY `award_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  
ALTER TABLE `wp_ns_education`
  MODIFY `edu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
  
ALTER TABLE `wp_ns_gallery`
  MODIFY `gallery_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
  
ALTER TABLE `wp_ns_headermenu`
  MODIFY `headermenu_id` bigint(22) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
  
ALTER TABLE `wp_ns_headers`
  MODIFY `header_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `wp_ns_hobbies`
  MODIFY `hobby_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `wp_ns_home`
  MODIFY `home_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `wp_ns_languages`
  MODIFY `lang_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `wp_ns_projects`
  MODIFY `project_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `wp_ns_publications`
  MODIFY `pub_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `wp_ns_researches`
  MODIFY `research_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `wp_ns_traits`
  MODIFY `trait_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `wp_ns_workexp`
  MODIFY `workexp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `wp_ns_aboutfields`
  ADD CONSTRAINT `FK_AF_POSTID` FOREIGN KEY (`aboutfield_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_achievements`
  ADD CONSTRAINT `FK_ACH_POSTID` FOREIGN KEY (`achv_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_awards`
  ADD CONSTRAINT `FK_AWARDS_POSTID` FOREIGN KEY (`award_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_education`
  ADD CONSTRAINT `FK_EDU_POSTID` FOREIGN KEY (`edu_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;


ALTER TABLE `wp_ns_gallery`
  ADD CONSTRAINT `FK_GALLERY_POSTID` FOREIGN KEY (`gallery_post_id`) REFERENCES `wp_posts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wp_ns_gallery_posts`
  ADD CONSTRAINT `FK_GALLERYMEDIA_GALLERYID` FOREIGN KEY (`gallery_id`) REFERENCES `wp_ns_gallery` (`gallery_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_GALLERYMEDIA_POSTID` FOREIGN KEY (`post_id`) REFERENCES `wp_posts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wp_ns_headermenu`
  ADD CONSTRAINT `FK_HEADERMENU_POSTID` FOREIGN KEY (`headermenu_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_headers`
  ADD CONSTRAINT `FK_HEADERS_PAGE_POST_ID` FOREIGN KEY (`header_page_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HEADERS_POSTID` FOREIGN KEY (`header_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_hobbies`
  ADD CONSTRAINT `FK_HOBBIES_POSTID` FOREIGN KEY (`hobby_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_home`
  ADD CONSTRAINT `FK_HOME_GALLERY_ID` FOREIGN KEY (`home_gallery_id`) REFERENCES `wp_ns_gallery` (`gallery_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_HOME_TERM_ID` FOREIGN KEY (`home_term_id`) REFERENCES `wp_terms` (`term_id`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_languages`
  ADD CONSTRAINT `FK_LANG_POSTID` FOREIGN KEY (`lang_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_projects`
  ADD CONSTRAINT `FK_PROJECTS_BACKGROUNDPOSTID` FOREIGN KEY (`project_background_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PROJECTS_FOREGROUNDPOSTID` FOREIGN KEY (`project_foreground_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PROJECTS_GALLERYID` FOREIGN KEY (`project_gallery_id`) REFERENCES `wp_ns_gallery` (`gallery_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PROJECTS_PAGE_POSTID` FOREIGN KEY (`project_page_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PROJECTS_POSTID` FOREIGN KEY (`project_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_projects_terms`
  ADD CONSTRAINT `FK_PROJECTSTERMS_PROJECTID` FOREIGN KEY (`project_id`) REFERENCES `wp_ns_projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PROJECTSTERMS_TERMID` FOREIGN KEY (`term_id`) REFERENCES `wp_terms` (`term_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `wp_ns_publications`
  ADD CONSTRAINT `FK_PUBLICATIONS_POSTID` FOREIGN KEY (`pub_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;

ALTER TABLE `wp_ns_publications_terms`
  ADD CONSTRAINT `FK_PUBTERMS_PUBID` FOREIGN KEY (`pub_id`) REFERENCES `wp_ns_publications` (`pub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PUBTERMS_TERMID` FOREIGN KEY (`term_id`) REFERENCES `wp_terms` (`term_id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
ALTER TABLE `wp_ns_researches`
  ADD CONSTRAINT `FK_RESEARCHES_GALLERY_ID` FOREIGN KEY (`research_gallery_id`) REFERENCES `wp_ns_gallery` (`gallery_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RESEARCHES_PAGE_POSTID` FOREIGN KEY (`research_page_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;
  
ALTER TABLE `wp_ns_researches_terms`
  ADD CONSTRAINT `FK_RESEARCHESTERMS_RESEARCHID` FOREIGN KEY (`research_id`) REFERENCES `wp_ns_researches` (`research_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RESEARCHESTERMS_TERMID` FOREIGN KEY (`term_id`) REFERENCES `wp_terms` (`term_id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
ALTER TABLE `wp_ns_traits`
  ADD CONSTRAINT `FK_TRAITS_POSTID` FOREIGN KEY (`trait_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;
  
ALTER TABLE `wp_ns_workexp`
  ADD CONSTRAINT `FK_WORKEXP_POST_ID` FOREIGN KEY (`workexp_post_id`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE;
