@extends('web.layouts.app')

@section('meta')
    {!! seo($SEOData) !!}
@endsection
@section('css')
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4 gradient-text">Online m3u8 Player</h2>
        <h4 class="text-center mb-4 gradient-text">Stream m3u8 Files with Direct Link Playback</h4>

        <!-- Video Upload Form -->
        <div class="mb-4">
            <label for="urlInput" class="form-label">HLS Stream URL:</label>
            <input type="text" class="form-control" id="urlInput"
                value="https://devstreaming-cdn.apple.com/videos/streaming/examples/adv_dv_atmos/main.m3u8"
                placeholder="Enter HLS URL (e.g., .m3u8 link)">
            <button onclick="playVideo()" class="btn btn-primary w-100 mt-3">Play</button>
        </div>

        <!-- Video Element for Uploaded Video -->
        <div class="mb-3 w-100">
            {{-- <video id="videoPreview" class="" controls></video> --}}
            <video id="videoPlayer" controls style="width: 100%; max-width: 600px;">
                HLS Video Player
            </video>
        </div>


        <x-web.tools.share-buttons url="url()->current()" text="Check out this amazing post!" />

        <!-- Container for the whole page -->
        <div class="container my-5">

            <!-- Header Section -->
            <div class="row">
                <div class="col-12 text-center">
                    <h2>How to Use the m3u8 Player Online Direct Link to Play : Step-by-Step Guide</h2>
                    <p>The <strong>m3u8 Player Online Direct Link to Play tool</strong> is designed to provide seamless
                        playback of m3u8 video streams directly from a URL.</p>
                </div>
            </div>

            <img src="https://status9mme.com/storage/41/conversions/Test-M3u8-conversion.webp" class="img-fluid my-4 w-100 " alt="">

            <!-- Step-by-Step Guide Section -->
            <div class="row my-4">
                <div class="col-12">
                    <h3>Step-by-Step Instructions</h3>
                    <ul id="step-by-step">
                        <li>
                            <h5>1. Access the Tool</h5>
                            <p>Visit the <strong>m3u8 Player</strong> page on our website.</p>
                            <p>You will be presented with a user-friendly interface to input your m3u8 stream link.</p>
                        </li>
                        <li>
                            <h5>2. Enter Your m3u8 Link</h5>
                            <p>In the input box, paste your <strong>direct m3u8 URL</strong>.</p>
                            <p>Ensure that the URL is valid and accessible.</p>
                        </li>
                        <li>
                            <h5>3. Start the Playback</h5>
                            <p>After entering the m3u8 link, click the <strong>"Play"</strong> button.</p>
                            <p>The video player will automatically load and begin playing the m3u8 stream.</p>
                        </li>
                        <li>
                            <h5>4. Customize Video Controls</h5>
                            <p>You can adjust the video quality, toggle fullscreen mode, and control volume using the
                                built-in video controls provided by the player.</p>
                        </li>
                        <li>
                            <h5>5. Troubleshooting</h5>
                            <p>If the video doesn't load, ensure that the m3u8 URL is correct and the stream is publicly
                                accessible.</p>
                        </li>
                        <li>
                            <h5>6. Enjoy Seamless Streaming</h5>
                            <p>Once the video starts playing, sit back and enjoy a smooth, buffer-free experience.</p>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Features Section -->
            <div class="row my-4">
                <div class="col-12">
                    <h2>Features of the m3u8 Player Online Direct Link to Play</h2>
                    <ul>
                        <li><strong>Easy-to-Use Interface:</strong> Simple input box for pasting the m3u8 URL and instant
                            video playback.</li>
                        <li><strong>Seamless Video Playback:</strong> Stream m3u8 files without the need for additional
                            software or downloads.</li>
                        <li><strong>Responsive Design:</strong> Works smoothly on desktop, tablet, and mobile devices for a
                            consistent experience.</li>
                        <li><strong>Fullscreen Mode:</strong> Watch videos in fullscreen mode for an immersive viewing
                            experience.</li>
                        <li><strong>Multiple Stream Support:</strong> Test different m3u8 URLs for various video streams and
                            formats.</li>
                        <li><strong>High-Quality Playback:</strong> Enjoy videos in high definition with no buffering
                            issues.</li>
                        <li><strong>Browser Compatibility:</strong> Supports modern browsers such as Chrome, Firefox, and
                            Safari.</li>
                        <li><strong>No Installation Required:</strong> Just paste the link and start watching—no need for
                            additional software installations.</li>
                    </ul>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="row my-4">
                <div class="col-12">
                    <h3>Tips:</h3>
                    <ul>
                        <li><strong>Multiple m3u8 Streams:</strong> You can try different m3u8 URLs to test multiple streams
                            and compare playback performance.</li>
                        <li><strong>Full-Screen Mode:</strong> You can switch to full-screen mode for a more immersive
                            viewing experience.</li>
                    </ul>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="row my-4">
                <div class="col-12">
                    <h2>Frequently Asked Questions (FAQ)</h2>

                    <h5>1. What is an m3u8 link?</h5>
                    <p>An m3u8 link is a multimedia playlist file format used to stream video and audio content. It is
                        commonly used for streaming services and supports live and on-demand video playback.</p>

                    <h5>2. How can I get an m3u8 link?</h5>
                    <p>You can obtain an m3u8 link from your video hosting platform or any service that provides live video
                        streams.</p>

                    <h5>3. What should I do if my video doesn't load?</h5>
                    <p>If your video doesn't load, verify that the m3u8 URL is correct and publicly accessible. Also, ensure
                        you're using a modern browser like Chrome, Firefox, or Safari.</p>

                    <h5>4. Is this tool compatible with all browsers?</h5>
                    <p>The tool is compatible with modern browsers such as Google Chrome, Firefox, Safari, and Edge.</p>

                    <h5>5. Can I use this tool on mobile devices?</h5>
                    <p>Yes, the m3u8 player is fully responsive and works smoothly on both mobile and desktop devices,
                        ensuring a seamless experience across all platforms.</p>

                    <h5>6. Do I need to install anything to use this tool?</h5>
                    <p>No, this tool runs entirely in your browser. There’s no need to install additional software or
                        plugins.</p>

                    <h5>7. How can I adjust the video quality?</h5>
                    <p>The player automatically adjusts the video quality based on your internet connection. However, if the
                        player offers quality controls, you can manually select your preferred video resolution.</p>
                </div>
                <img src="https://status9mme.com/storage/40/conversions/DALL%C2%B7E-2024-11-16-18.34.52---A-modern-and-sleek-thumbnail-for-an-online-tool-titled-'Free-M3U8-Player---Test-HLS-Streams-Online'.-The-design-features-a-computer-screen-playing-a-v-conversion.webp" class="img-fluid my-4 w-50 h-50 img-responsive center-block" alt="">
            </div>

        </div>


    </div>
@endsection

@section('script')
    <script>
        function playVideo() {
            const video = document.getElementById('videoPlayer');
            const url = document.getElementById('urlInput').value;

            if (Hls.isSupported() && url) {
                const hls = new Hls();
                hls.loadSource(url);
                hls.attachMedia(video);
                hls.on(Hls.Events.MANIFEST_PARSED, function() {
                    video.play();
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                // Support for Safari
                video.src = url;
                video.addEventListener('loadedmetadata', function() {
                    video.play();
                });
            } else {
                alert('HLS not supported.');
            }

        }

        //call function
        document.addEventListener('DOMContentLoaded', () => {
            playVideo();
        });
    </script>

    {!! $videoToImagePageSchema->toScript() !!}
@endsection
