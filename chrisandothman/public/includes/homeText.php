	      	<div id="bodyText">

		        <a id="home" name="home" class="anchor"></a>
		        
		        <div id="usPic" class="picLink">
			       	<a href="assets/us.jpg" target="_blank" title="Newly engaged in the rainforest">
			       		<img src="assets/usThumb.jpg" alt="Newly engaged in the rainforest" class="img-thumbnail">
			       	</a><br />
			       	<small class="text-center text-muted"><em>Newly engaged in the rainforest</em></small>
		        </div>
		        
		        <p>
		        	Hi there,
		        </p>
		        <p>
		        	Thank you for visiting this web site for the wedding of Chris Asuquo and Othman Smihi. As you may know, we have been a couple for a number of years now and finally got engaged this summer while on a semi-spontaneous trip to Puerto Rico. We're pretty excited about the whole thing and have decided not to waste any time so we're getting married this month (October 2013)! 
		        </p>
		        <p>
		        	This web site should have all the information about the wedding that you'll need to know. If you haven't <a href="/?p=rsvp">RSVP'd</a> yet, you can do so by clicking <a href="/?p=rsvp">this link</a> or the one in the upper right corner. Otherwise, check below for all the details about the where and when. 
		        </p>
		        <p>	
		        	Thank you for being a part of our celebration. We can't wait to see you there!
		        </p>
	
		        <a id="date" name="date" class="anchor"></a>
		        <h2>Date</h2>
		        <p>
		        	We'll be getting married on <strong>Sunday, October 20</strong>. The ceremony will be at 4:00 pm, followed by dinner and general celebration-type stuff.
		        </p>
		        
		        <a id="location" name="location" class="anchor"></a>
		        <h2>Location</h2>
		        <div class="picLink">
			       	<a href="assets/McNamara.jpg" target="_blank" title="McNamara Alumni Center">
			       		<img src="assets/McNamaraThumb.jpg" alt="McNamara Alumni Center" class="img-thumbnail">
			       	</a><br />
			       	<small class="text-center text-muted"><em>McNamara Alumni Center</em></small>
		        </div>

		        <p>
		        	The event will take place at the McNamara Alumni Center on the University of Minnesota campus in Minneapolis. We'll have the ceremony in one room, then move over to another for dinner, drinks, and dancing (or just hanging out). 
		        </p>
		        
		        <p>	
		        	Since we're a small group (about 50 people), there'll be plenty of room to move around. If the weather is nice, there's also a little patio outside with tables and chairs to sit at.
		        </p>

		        <div class="text-right google-map-canvas">
		        	<iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=200+SE+Oak+St,+Minneapolis,+MN+%E2%80%8E&amp;aq=&amp;sll=44.975637,-93.227963&amp;sspn=0.008607,0.021136&amp;ie=UTF8&amp;hq=&amp;hnear=200+SE+Oak+St,+Minneapolis,+Hennepin+County,+Minnesota+55455&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
		        	<a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=200+SE+Oak+St,+Minneapolis,+MN+%E2%80%8E&amp;aq=&amp;sll=44.975637,-93.227963&amp;sspn=0.008607,0.021136&amp;ie=UTF8&amp;hq=&amp;hnear=200+SE+Oak+St,+Minneapolis,+Hennepin+County,+Minnesota+55455&amp;t=m&amp;z=14&amp;iwloc=A" target="_blank">
		        		<small class="text-right">
		        			<em>View Larger Map</em>
		        		</small>
		        	</a>
		        </div>
		        
		        <a id="dress" name="dress" class="anchor"></a>
		        <h2>Dress Code</h2>
		        <p>
		        	There is no official dress code for our wedding. I'll be wearing a tuxedo and Chris will be wearing a presumably lovely dress which has been kept top secret from me. That being said, things will be pretty laid back. I've been telling people we don't mind if they wear sweatpants, but Chris has strongly encouraged me to stop saying that. So just to be on the safe side, if you're going to wear sweatpants, put on your dressiest pair.
		        </p>

		        <a id="food" name="food" class="anchor"></a>
		        <h2>Food & Drink</h2>
		        <p>
		        	Our wedding will have plenty of delicious food to enjoy. Here's what we have planned: 

					<?php 
						$stmt = $db->prepare("SELECT `name`, `description`, `category`, `kid` FROM `Menu`");
						$stmt->execute();
						$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
					?>
					
					<h3>Salad</h3>
					
					<ul class="textList">	
						<?php 	
							foreach( $res as $r ) {
								if ( $r['category'] == 'salad') {
									echo '<li>' . $r['description'] . '</li>';
								}
							}
						?>
					</ul>
	
					<h3>Entr&eacute;es</h3>

					<p>You'll choose one of these when you <a href="/?p=rsvp">RSVP</a>.</p>

					<ul class="textList">
						<?php 	
							foreach( $res as $r ) {
								if ( $r['category'] == 'entree' && $r['kid'] != 1) {
									echo '<li>' . $r['description'] . '</li>';
								}
							}
						?>
					</ul>
					
					<p>And for the kids:</p>

					<ul class="textList">
						<?php 	
							foreach( $res as $r ) {
								if ( $r['category'] == 'entree' && $r['kid'] == 1) {
									echo '<li>' . $r['description'] . '</li>';
								}
							}
						?>
					</ul>

					<h3>Dessert</h3>

					<p>Chris has found a delicious gluten-free coconut cake that will be available for our GF guests. Meanwhile, the rest of us will be enjoying some kind of triple chocolate cake which may end up as a quintuple chocolate cake if I have anything to say about it.</p> 

					<h3>Drinks</h3>

					<p>There will also be a bar available. It'll be on the house for an hour, but after that you're on your own.</p>

					<ul class="textList">
						<li>
							<strong>Non-alcoholic</strong>: Cider, juice, coffee, tea, hot chocolate, lemonade, soda, fancy water, etc. 
						</li>
						<li>
							<strong>Beer</strong>: Heineken, Amstel Light, Corona, Schells Pilsner, Summit EPA, James Page, Michelob
						</li>
						<li>
							<strong>Wine</strong>: I don't know anything about wine, but it seems they'll have a lot of it.
						</li>
						<li>
							<strong>Cocktails</strong>: Boozes of varying type and pedigree will be available.
						</li>
					</ul>
		        	
		        </p>
		        
		        <a id="gifts" name="gifts" class="anchor"></a>
		        <h2>Gifts</h2>
		        <p>
		        	We have to admit, this part feels a little awkward to us. We don't really need you to buy us anything for our wedding; your gift is that you're coming to spend the day and celebrate with us.  
		        </p>
		        
		        <p>
		        	At the same time, we realize that some people may want to get us something anyway and they'd appreciate a hint. If you happen to be one of those people, here are some options:
		        </p>

	        	<ul class="textList">
	        		<!-- <li>
	        			<a href="http://www.target.com/wedd/registry/5S33pI3RAtWyXL2rMVOkww" target="_blank"><strong>Buy a gift from our registry at Target</strong></a>. We'll be picking out a few items that may be helpful to us at home, which you can find at a Target store or online <a href="http://www.target.com/wedd/registry/5S33pI3RAtWyXL2rMVOkww" target="_blank">here</a>. <em>Note: The Target registry's empty right now, but we'll be adding stuff this week.</em>
	        		</li> -->
	        		<li>
	        			<a href="http://www.toysrus.com/registry/link/index.jsp?overrideStore=TRUS&registryNumber=51275751#.UlIhHrAVgaA.gmail" target="_blank"><strong>Buy us a gift from our Babies "R" Us registry</strong></a>. Well, I know we had a Target registry up here and we intended on setting one up, but with all the wedding excitement we kind of neglected it. However, we did go pick out some items at Babies 'R' Us which will almost certainly be even more helpful to us. If you feel inclined to get us a gift, feel free to pick out something from our list <a href="http://www.toysrus.com/registry/link/index.jsp?overrideStore=TRUS&registryNumber=51275751#.UlIhHrAVgaA.gmail" target="_blank">here</a> if you like.
	        		</li>
	        		<li>
	        			<a><strong>Donate to a charity that we support</strong></a>. Some organizations we like are <a href="http://aguiladeesperanza.com/" target="_blank">&Aacute;guila de Esperanza</a> (Chris' business where she takes MN families on learning trips to Guatemala-- donate by check), <a href="http://www.oxfam.org/" target="_blank">Oxfam</a> (I bought Chris a goat for her birthday once), <a href="https://www.eff.org/" target="_blank">Electronic Frontier Foundation</a>. 
	        		</li>
	        	</ul>
		        
		        <p>
		        	Thank you for everything. We can't wait to see you there!
		        </p>

	        </div> <!-- bodyText -->