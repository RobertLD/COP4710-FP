use COP4710_FP;

# Create a superadmin account with username "superadmin" and password "root"

INSERT INTO `user` (`username`,`password_hash`,`tmp_password`,`email`,`first_name`,`last_name`,`admin_level`)
VALUES ("superadmin","$2y$10$3EiBtE.lF7EgpZzn.CPSNO95WNJCsZFBnVbfYTojwBvyRaNTvQEoG",0,"","Super","Admin",3);

INSERT INTO `staff` (`user_id`,`username`,`superadmin`)
VALUES (1,"superadmin",1);


# Create a catalog of books to pick from

INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("Calculus 3 Essentials","Kristen Rodgers","15.1","Magnis Ltd","777253797"),
  ("Intro to Discrete Mathamatics","Leigh Garcia","15.0","Arcu Company","454286832"),
  ("A Guide to the Musical Arts","Davis Holcomb","14.5","Odio Etiam Ligula Ltd","478196468"),
  
  ("arcu. Vivamus","Laura Cervantes","15.2","Luctus Ut Corporation","850495339"),
  ("Pellentesque ut","Rama Kinney","15.1","Rutrum Urna LLC","281513161"),
  ("erat neque","Ocean James","14.8","Lorem Lorem Corp.","828516055"),
  ("Suspendisse sed","Jared Henderson","14.9","Arcu Vestibulum Associates","108337722"),
  ("Morbi sit","Kitra Shields","15.2","In Sodales Corp.","347464846"),
  ("sodales elit","Clarke Bridges","14.9","Turpis Associates","677510860"),
  ("non, feugiat","Ulla Melton","15.0","Pede Suspendisse Company","258563173");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("metus. Vivamus","Holmes Buck","14.8","Morbi Inc.","285573293"),
  ("faucibus. Morbi","Angela Wilson","15.0","Dictum Sapien Aenean Limited","193482817"),
  ("tortor, dictum","Benjamin Singleton","14.9","Euismod In PC","620355584"),
  ("in consectetuer","Tatiana Brewer","15.2","Risus Nunc Ac Industries","268714354"),
  ("nec, eleifend","Lilah Boyer","14.8","Amet LLP","387608367"),
  ("egestas rhoncus.","Dana Trujillo","15.2","Dolor Dolor Tempus LLC","156514035"),
  ("erat vitae","Paloma Booth","14.9","Nulla Tincidunt Corp.","591803561"),
  ("felis eget","Wyatt Holden","15.4","Aliquam Enim Inc.","332552915"),
  ("lacus. Ut","Yeo Spence","14.8","Gravida Non Sollicitudin Corporation","525059579"),
  ("scelerisque mollis.","Chase Colon","15.1","Integer Eu PC","043985557");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("tincidunt tempus","Rhoda Morgan","14.9","Sed Limited","474041214"),
  ("tincidunt, nunc","Valentine Jimenez","15.2","Venenatis Lacus Associates","852803171"),
  ("non nisi.","Kennedy Roth","15.1","Pede Cras Vulputate Institute","423939684"),
  ("Curae Donec","Knox Cain","15.0","Sed Orci Lobortis Limited","992253478"),
  ("Morbi neque","Ruth Park","15.1","Id Sapien LLC","015542734"),
  ("euismod mauris","Amena Berger","15.0","In Faucibus Orci Industries","468657897"),
  ("nec metus","Vladimir Barnett","15.1","A Magna Industries","175226318"),
  ("eu dolor","Jessica Richmond","15.0","Nec Tempus LLP","077071228"),
  ("Fusce aliquet","Zorita Parsons","15.1","Et Corp.","925153894"),
  ("dui augue","Isaac Calhoun","15.2","In Faucibus Incorporated","191448385");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("eu arcu.","Lunea Maddox","15.0","Sodales Corporation","442879810"),
  ("eu erat","Dane Flores","15.3","Ipsum LLP","826431198"),
  ("accumsan interdum","Gil Smith","15.1","Euismod Inc.","546165585"),
  ("sollicitudin adipiscing","Zenia Larsen","14.9","Elit Elit Industries","284795337"),
  ("nec, cursus","Nola Bond","15.0","Ac Risus Institute","495464316"),
  ("natoque penatibus","Igor Moran","14.8","Turpis Company","254723339"),
  ("Quisque imperdiet,","Isabella Campos","15.2","Lectus Justo Foundation","966278127"),
  ("a felis","Maxine Cole","14.8","Velit Quisque Corporation","348710997"),
  ("Ut tincidunt","Rigel Rose","14.9","Tincidunt Donec Corporation","271491363"),
  ("Quisque libero","Burke Mcguire","15.3","Feugiat Sed PC","797550445");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("nunc sed","Cathleen Suarez","14.6","Fermentum Vel Associates","901755773"),
  ("laoreet, libero","Keegan Gillespie","15.0","Curabitur Vel Limited","745443489"),
  ("Nunc mauris","Gregory Roth","14.8","Risus Consulting","854947527"),
  ("elit elit","Harper Boyle","15.1","Vehicula Pellentesque Institute","364541163"),
  ("imperdiet nec,","Brady Herrera","14.9","Sollicitudin A Malesuada Ltd","371815082"),
  ("elit. Curabitur","Destiny Merritt","15.1","Senectus Et LLC","744222479"),
  ("natoque penatibus","Zane Baxter","15.2","Mauris Morbi Limited","231141165"),
  ("Cras interdum.","Kuame Shelton","14.9","Non Dui Limited","803765574"),
  ("Proin velit.","Melissa Carlson","14.7","Mus Aenean Eget Associates","555339936"),
  ("turpis non","Porter Clements","14.4","Rutrum Fusce Dolor PC","958778350");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("sed, facilisis","Miriam Rosario","14.6","Euismod Urna Ltd","851222486"),
  ("magna. Phasellus","Hermione Tucker","15.1","Cursus Vestibulum Corp.","647044459"),
  ("non, vestibulum","Talon Sandoval","15.5","Luctus Limited","344813158"),
  ("aliquet, metus","Hadley Mckee","15.2","Aliquam LLC","171313516"),
  ("feugiat placerat","Mallory Slater","14.9","Urna PC","767454072"),
  ("Vestibulum accumsan","Hayes Farrell","15.2","Eleifend Nunc Risus Associates","824102029"),
  ("erat eget","Forrest Russo","14.6","Vitae Orci Inc.","639075783"),
  ("lorem ac","Kirsten O'connor","15.2","Nam Consequat Dolor Company","331242856"),
  ("nec luctus","Lydia Ashley","15.0","Nec Urna Corp.","361315139"),
  ("molestie tellus.","Elliott Castillo","15.0","Urna Nunc PC","614456365");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("adipiscing fringilla,","Joel Jacobson","15.1","Congue Elit LLC","355109342"),
  ("nec mauris","Gannon Buckley","15.0","Vivamus Corporation","527575114"),
  ("placerat. Cras","Angelica Ryan","15.0","Curabitur Massa Vestibulum Corporation","058174001"),
  ("congue, elit","Boris Barnes","15.0","Pellentesque Eget Dictum PC","755084651"),
  ("nisi. Cum","Griffin Dale","14.9","Ut Aliquam Iaculis Incorporated","548665244"),
  ("neque. In","Quintessa Koch","15.0","Aenean Incorporated","257211951"),
  ("nec, mollis","Emery Jacobson","14.9","Interdum Enim LLP","837430532"),
  ("sed, facilisis","Imelda Dudley","15.1","Justo Sit Consulting","859994575"),
  ("risus, at","Xanthus Clarke","14.8","Donec Corp.","310017325"),
  ("ut mi.","Cullen Wagner","14.6","Semper Auctor Inc.","263255382");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("neque. In","Carter Ross","15.1","Purus PC","526553568"),
  ("massa lobortis","Stephen Mcintyre","15.5","Rhoncus Proin Nisl Institute","558658265"),
  ("Nulla aliquet.","Jaime Cantrell","15.6","Sapien Cras Associates","614556744"),
  ("sodales elit","Kylynn George","14.9","Lacinia Orci LLP","742238353"),
  ("ac metus","Ralph Ramsey","15.2","Vel Sapien Consulting","184461626"),
  ("elit erat","Jelani Osborn","15.0","Placerat Cras Associates","613126107"),
  ("tellus faucibus","Debra Luna","14.7","At Incorporated","078119674"),
  ("dictum. Proin","Joseph Brady","15.3","Mauris Blandit Mattis LLP","902738033"),
  ("justo sit","Hedley Hyde","15.3","Euismod Associates","744255621"),
  ("Aliquam ultrices","Chanda Holcomb","15.0","Semper Et Incorporated","050524134");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("facilisis. Suspendisse","Yardley Shaffer","15.0","Ultrices A Consulting","546455234"),
  ("et tristique","Lev Schmidt","14.4","Diam At Ltd","397838575"),
  ("imperdiet ornare.","Hammett Tate","14.6","Orci In Consequat Institute","707481362"),
  ("Vivamus sit","Nathan Cummings","14.7","Aliquet Vel Limited","873655827"),
  ("quis arcu","Jackson Flowers","15.2","Convallis Convallis Dolor Corporation","866787692"),
  ("dignissim tempor","Daquan Cooke","15.0","Sed Facilisis LLC","397521171"),
  ("venenatis vel,","Odette Banks","14.9","Dui Quis LLC","318783765"),
  ("eu tempor","Slade Santiago","14.9","Nulla Limited","335816824"),
  ("Integer in","Colette Armstrong","15.0","Tempus Eu Ligula Institute","946328358"),
  ("Cum sociis","Hamish Gilbert","15.4","Cursus Associates","465318507");
INSERT INTO `book` (`title`,`author`,`edition`,`publisher`,`ISBN`)
VALUES
  ("auctor, nunc","John Lewis","15.2","In Mi Pede Foundation","311756448"),
  ("habitant morbi","Benjamin Fulton","15.1","Curabitur Vel Institute","615477005"),
  ("facilisis eget,","Jena Hart","15.1","Massa Quisque LLC","296686503"),
  ("enim, sit","Inez Andrews","14.8","Mauris PC","217983612"),
  ("Donec feugiat","Kitra Baird","15.1","Etiam Laoreet Industries","658492347"),
  ("libero at","Chester Jarvis","14.6","Sed Consequat LLC","608774263"),
  ("et magnis","Ryder Hudson","14.9","Dui Suspendisse Ac Inc.","070412184"),
  ("scelerisque neque.","Jeanette Campbell","15.2","Mauris Rhoncus LLP","312525911"),
  ("orci, consectetuer","Ciara Lawson","14.8","Luctus Et Ultrices LLC","877989213"),
  ("in, hendrerit","Gray Kirby","15.0","Adipiscing Industries","621648045");

  


