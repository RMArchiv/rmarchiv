@extends('layouts.app')
@section('pagetitle', 'We`ll always have Paris.')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        We`ll always have Paris.
                    </div>
                    <div class="card-body">
                        <p><a href="{{ url('/') }}">Deutsche Version</a></p>
                        <p>ATTENTION! PLAY THE SONG WHILE READING THE TEXT BELOW!</p>
                        <p>
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/jU-323rNfsc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </p>
                        <p>Hello everyone,</p>

                        <p>It&#39;s a beautiful and warm day here in Germany. I have a late shift and was able to celebrate my daughter&#39;s birthday this morning. That definitely sounds like a wonderful start to the day. Doesn&#39;t it?</p>

                        <p>&quot;Yeah but ryg, if your day was so great, what&#39;s going on here?&quot;</p>

                        <p>That is indeed a good question. I will tell you.</p>

                        <p>Another page I hosted was a message board in the style of the Quartier. The Quartier was an old German RPG Maker community and the official page is gone by now. At some point, some former users of the Quartier found their way there. Since it was actually used for something from time to time, I simply kept it running. I only had to delete the &quot;creativity&quot; of spambots from time to time. Yesterday evening, after the late shift and preparations for my daughter&#39;s birthday, I thought it was time again for message deletions.</p>

                        <p>I came across several threads that had non-suspicious titles such as Vampires Dawn 3. Vampires Dawn is a popular RPG Maker game series in Germany and many are hyped for the soon to be released 3rd game. So definitely something you would expect in an RPG Maker related forum. After clicking on the thread, however, I was presented with pornographic images of the most disgusting kind.</p>

                        <p>At this point I thought this is just a spambot spreading a very special message and I started to delete this. But then I noticed a spam bot with the nickname &quot;ryg&#39;s anus cancer&quot; who came up with thread titles like &quot;RYG&#39;S PARENTS SHOULD POSTNATALLY ABORT HIM!&quot;, &quot;RYG, KILL YOURSELF YOU ASSHOLE&quot; or &quot;RYG IS THE SON OF A BITCH&quot;.</p>

                        <p>You know, I am a very tolerant person. I have always let a lot of borderline things pass. I have always tried to mediate and have only ever taken action when there was really no other way. But here a boundary was crossed. I was personally insulted in a completely inacceptable way.</p>

                        <p>So I started to investigate. phpBB, the forum software of the Quartier, stores the IP addresses of its users. The same applies to the Apache webserver. The IP addresses are stored in the server logs. And lo and behold: All users who had posted this pornographic content used the same IP. Not very clever if you ask me, but okay. You can do it that way.</p>

                        <p>According to Apache the same IP logged into the rmarchiv at the same time. Because the rmarchiv does not track the IPs of the users it is not possible to figure out the username directly. However, I track which users are logged in the archive. (This was once intended for a &quot;Who is online&quot; feature). And you know what? Only 2 users come into question. Now comes the conclusion: Two persons minus myself is one person. Uhm, yeah. But do not ask me about the nickname. If it turns out that my research was inccorect, I don&#39;t want to do a false accusation.</p>

                        <p>I asked myself: What am I doing now? Do I accept it? Do I become active? How is an almost dead message board related to the shutdown of the rmarchiv?</p>

                        <p>I know who did this. I know to which circles this expert belongs. What I don&#39;t know is how they will react. They have been destructive enough before. Who knows, maybe they have nothing to do with it? There are many questions I do not know the answer to. The logical conclusion here is to give up.</p>

                        <p>But no, dear friends. I will not give up. I will not bend the knee. Also not the knee of this, until now, perfectly working rmarchiv. A &quot;neutral zone&quot; where RPG Maker games of all communities are welcome. A place where almost everyone could find a place to play their games. And the idea of preserving the legacy of 20 years of, mostly German, RPG Maker history.</p>

                        <p>So instead of celebrating the birthday with my daughter, I took screenshots and collected logfiles. Then I took them to the nearest police station to file a complaint. Once for the personal insult and once for the distribution of pornographic material in an area accessible to minors.</p>

                        <p>In order to avoid further &quot;spam&quot; attacks (the moderation tools of the rmarchiv are very basic) and other vandalism, I am simply pulling the plug for an indefinite period of time. And even if the rmarchiv does come back, I will be much less tolerant.</p>

                        <p>For condolences or questions that have nothing to do with the case described here, feel free to write to send a message to the mail address given in the footer. The Discord Channel (see below) still exists =)</p>

                        <p>In spite of everything, I would like to thank you all. For using the rmarchiv. For sharing information and metadata and for uploading. Thanks for everything.</p>

                        <p>Best regards,</p>

                        <p>ryg</p>

                        <p><iframe src="https://discord.com/widget?id=269382903450959872&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection