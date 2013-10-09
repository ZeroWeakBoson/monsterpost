<?php
	class MY_TwitterWidget extends WP_Widget {
		function MY_TwitterWidget() {
			$widget_ops = array(
				'classname' => 'twitter',
				'description' => __('A widget that displays the latest tweets', 'cherry')
			);
			$this->WP_Widget( 'twitter-widget', __('Cherry - Twitter', 'cherry'), $widget_ops );
		}   // Widget Settings  
 
		function widget($args, $instance) {
			extract( $args );
 
			$title      = apply_filters('widget_title', $instance['title'] );
			$numb       = $instance['numb'];
 
			echo $before_widget;
 
			// Display the widget title
			if ( $title )
				echo $before_title . $title . $after_title;
 
			$opt_args = array(
				'trim_user'         => false,
				'exclude_replies'   => false,
				'include_rts'       => true
			);
			$tweets = getTweets($numb, false, $opt_args);
 
			if ( is_array($tweets) ){
 
				// to use with intents
				echo "<div class='twitter'>";
				echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';
				echo "<ul class='tweet_list unstyled'>";
 
				foreach($tweets as $tweet){
 
					echo '<li class="clearfix">';
					echo '<div class="tweet_item">';
					echo '<div class="tweet_content">';
					$user = $tweet['user'];
 
					// Tweet author avatar
					if ( array_key_exists('profile_image_url', $user) ) {
						$avatar = $user['profile_image_url'];
					}
 
					// Tweet author name
					if ( array_key_exists('name', $user) ) {
						$name = $user['name'];
					}
					// Tweet author @username
					if ( array_key_exists('screen_name', $user) ) {
						$screen_name = $user['screen_name'];
					}
 
					if ( !$name ) $name = 'YOURUSERNAME';
					if ( !$screen_name ) $screen_name = 'YOURUSERNAME';
 
					echo '<div class="stream-item-header">';
					echo '<a class="account-group" href="http://twitter.com/'.$screen_name.'" target="_blank">';
						if ( isset($avatar) ) {
							echo '<img class="avatar" src="'.$avatar.'" alt="'.$name.'">';
						}
						echo '<strong class="fullname">' . $name . '</strong>';
						echo '<span class="username">@' . $screen_name . '</span>';
					echo '</a>';
					echo '</div>';
 
					if ( $tweet['text'] ){
						$the_tweet = $tweet['text'];
 
						if(is_array($tweet['entities']['user_mentions'])){
							foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
								$the_tweet = preg_replace(
									'/@'.$user_mention['screen_name'].'/i',
									'<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
									$the_tweet);
							}
						}
 
						if(is_array($tweet['entities']['hashtags'])){
							foreach($tweet['entities']['hashtags'] as $key => $hashtag){
								$the_tweet = preg_replace(
									'/#'.$hashtag['text'].'/i',
									'<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
									$the_tweet);
							}
						}
 
						if(is_array($tweet['entities']['urls'])){
							foreach($tweet['entities']['urls'] as $key => $link){
								$the_tweet = preg_replace(
									'`'.$link['url'].'`',
									'<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
									$the_tweet);
							}
						}
 
						echo '<div class="tweet_txt">' . $the_tweet . '</div>';
 
						echo '<div class="clearfix">';
							echo '
							<div class="twitter_intents">
								<span><a class="reply-tweet" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a></span>
								<span><a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a></span>
								<span><a class="favorite-tweet" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a></span>
							</div>';
 
							echo '
							<div class="timestamp">
								<a href="https://twitter.com/'.$screen_name.'/status/'.$tweet['id_str'].'" target="_blank">
									'. date('d M', strtotime($tweet['created_at'])) .'
								</a>
							</div>';
						echo "</div>";
					} else {
						echo '
						<br /><br />
						<a href="http://twitter.com/'.$screen_name.'" target="_blank">Click here to read '.$screen_name.'\'S Twitter feed</a>';
					}
					echo '</div>';
					echo '</div>';
					echo '</li>';
				}
				echo "</ul>";
				echo "</div>";
			}
 
			echo $after_widget;
 
		}   // display the widget  
 
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
 
			//Strip tags from title and name to remove HTML
			$instance['title']      = strip_tags( $new_instance['title'] );
			$instance['numb']       = strip_tags( $new_instance['numb'] );
 
			return $instance;
		}   // update the widget  
 
		function form($instance) {
			//Set up some default widget settings.
			$defaults = array(
				'title' => __('Latest Tweets', 'cherry'),
				'numb' => '3',
				'show_info' => true
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
 
			// Widget Title: Text Input  ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'cherry'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'numb' ); ?>"><?php _e('Number of Twets:', 'cherry'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'numb' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'numb' ); ?>" value="<?php echo $instance['numb']; ?>" />
			</p>
		<?php }  // and of course the form for the widget options
	}   // The twitter widget class
?>