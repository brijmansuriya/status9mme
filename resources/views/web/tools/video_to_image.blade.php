@extends('web.layouts.app')

@section('css')
    {!! seo($SEOData) !!}
    <style>
        .gradient-text {
            background: linear-gradient(90deg, #4b2478, #f955ff);
            /* Customize colors */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-family: 'Arial', sans-serif;
            font-size: 50px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('web/css/social-media-share-buttons.css') }}">
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4 gradient-text">Video Upload Frame Capture Tool</h2>

        <!-- Video Upload Form -->
        <div class="mb-4">
            <label for="videoInput" class="form-label">Upload Video File:</label>
            <input type="file" class="form-control" id="videoInput" accept="video/*">
        </div>

        <!-- Video Element for Uploaded Video -->
        <div class="mb-3">
            <video id="videoPreview" class="w-100 h-auto" controls></video>
        </div>

        <!-- Capture Frame Button -->
        <button id="captureFrame" class="btn btn-primary w-100" style="display:none;">Capture Frame</button>

        <!-- Canvas to Draw the Captured Frame (hidden for now) -->
        <canvas id="canvas" style="display:none;"></canvas>

        <!-- Captured Image Preview -->
        <div class="text-center mt-4">
            <h4>Captured Frame Preview</h4>
            <img id="capturedImagePreview" style="max-width: 100%; display:none;" />
        </div>

        <!-- Download Button -->
        <div class="text-center mt-4">
            <a id="downloadBtn" class="btn btn-success" style="display:none;">Download Image</a>
        </div>

       

        <x-web.tools.share-buttons url="url()->current()" text="Check out this amazing post!" />


        <div class="row">
            <h2>How to Use the Video Frame Capture Tool: Step-by-Step Guide</h2>
            <p>Welcome to our <strong>Video Frame Capture Tool</strong>! This easy-to-use tool allows you to upload a video,
                capture a frame, and download it as an image. Follow this step-by-step guide to get started quickly.</p>

            <h3>Step-by-Step Instructions</h3>
            <ol>
                <li><strong>Upload Your Video</strong>: Click on the "Choose File" button to upload a video from your
                    device. Supported video formats include <strong>MP4</strong>, <strong>mkv</strong>, and
                    <strong>other</strong>.
                </li>
                <li><strong>Preview the Video</strong>: After uploading, the video will appear in the video player. You can
                    now play the video to select the frame you want to capture.</li>
                <li><strong>Capture the Frame</strong>: Once you've selected the frame you want to capture, click on the
                    "Capture Frame" button. The tool will extract the image from the video.</li>
                <li><strong>Download the Image</strong>: After capturing the frame, you’ll see a download button. Click it
                    to save the image to your device.</li>
            </ol>

            <h3 class="w-100">Additional Features</h3>
            <ul>
                <li><strong>Multiple File Support:</strong> Upload videos in multiple formats including MP4, Mkv, and other.</li>
                <li><strong>Image Quality:</strong> Capture high-quality frames with no pixelation.</li>
                <li><strong>Easy Download:</strong> Download captured frames in popular formats such as JPG.</li>
            </ul>

            <h3 class="w-100">Frequently Asked Questions (FAQs)</h3>
            <dl>
                <dt>What video formats can I upload?</dt>
                <dd>Our tool supports MP4, WebM, and OGG formats for uploading videos.</dd>

                <dt>How do I capture a frame from my video?</dt>
                <dd>After uploading the video, click the "Capture Frame" button while the video is playing. The frame will
                    be saved instantly.</dd>

                <dt>How can I download the captured frame?</dt>
                <dd>Once the frame is captured, the "Download" button will appear. Click it to save the image.</dd>
            </dl>

            <p>Now that you know how to use our <strong>Video Frame Capture Tool</strong>, you can start extracting frames from your videos with ease. If you have any questions, feel free to contact us or check out our other <a href="#">video editing tools</a>.</p>

        </div>

    </div>
@endsection

@section('script')
    <script>
        const videoPreview = document.getElementById('videoPreview');
        const videoInput = document.getElementById('videoInput');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        const captureFrameButton = document.getElementById('captureFrame');
        const downloadBtn = document.getElementById('downloadBtn');
        const capturedImagePreview = document.getElementById('capturedImagePreview');

        // Handle video file upload
        videoInput.addEventListener('change', function() {
            const file = this.files[0];
            const url = URL.createObjectURL(file);
            loadVideo(url);
        });

        // Load the uploaded video into the video element
        function loadVideo(url) {
            videoPreview.src = url;
            videoPreview.style.display = 'block';
            captureFrameButton.style.display = 'block';
        }

        // Capture frame from video element
        captureFrameButton.addEventListener('click', function() {
            captureFrameFromVideo();
        });

        // Capture the current frame from the video
        function captureFrameFromVideo() {
            canvas.width = videoPreview.videoWidth;
            canvas.height = videoPreview.videoHeight;

            ctx.drawImage(videoPreview, 0, 0, canvas.width, canvas.height);

            const imageData = canvas.toDataURL('image/jpeg');
            downloadBtn.href = imageData;
            downloadBtn.download = 'frame.jpg';
            downloadBtn.textContent = 'Download Image';
            downloadBtn.style.display = 'block';

            // Show the captured image preview
            capturedImagePreview.src = imageData;
            capturedImagePreview.style.display = 'block';
        }
        
    </script>

    {!! $videoToImagePageSchema->toScript() !!}
@endsection
