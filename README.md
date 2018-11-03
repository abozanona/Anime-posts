# Anime-posts

This project was developed in *10/10/2017*

**Anime Posts** is a website for extracting, analysing and categorizing info,texts,images,videos and other data about [Case closed](https://en.wikipedia.org/wiki/Case_Closed) Anime. All these data where extracted from a Facebook group for the fans of *Case closed* anime.

## This project can:

 * Collect the facebook group posts.
 * Analyse the post content(text), add category to each post.
 * Guess about what character the post is talking about.
 * DO other things.

## Some of the Technologies, Methods:

 * At some point, Facebook prevented non-admins members from using their api to fetch the feed, so I fetched them by injecting my profile session cookies to my **curl** requests to the group and then by manipulating the DOM.
 * I used reversed engineering to get the source code of an application that views Case closed episodes, giving me some hints of the API routs that fetches the episods => With some luck I managed to get the `V3` routs of that api.
 * I used google cloud VM **Ubuntu** Instance to upload the website.
 * I used elastic search to index my data.
 * I used **animefaces** to recognise character in images.
 * I used **CURL** with bash script to be able to get the download link large videos on google drive.
 * I used **cron jobs** to fetch the content daily.
