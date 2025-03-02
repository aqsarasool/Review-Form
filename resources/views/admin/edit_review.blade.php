@extends('layouts.guest')
@php
    $title = 'Review Form';
@endphp

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            margin: 0;
            overflow-y: auto;
        }
        label{
            font-weight: bold;
            color: #888;
        }
        .container-fluid {
            background-color: #ffffff;
            padding: 70px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        form div {
            margin-bottom: 15px;
        }
        .dropzone {
            border: none;
            box-shadow: none; 
        }
        input[type="text"], input[type="email"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .dz-message {
            margin: 15px 0;
            text-align: center;
            color: #888;
            border: 2px dashed #ccc;
            padding: 30px 20px;
            border-radius: 6px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
        }
        .rating {
            direction: rtl;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .rating input {
            display: none;
        }
        .rating label {
            font-size: 2em;
            color: #ddd;
            cursor: pointer;
        }
        .rating label:hover,
        .rating label:hover ~ label,
        .rating input:checked ~ label {
            color: #f7d106;
        }
        .rating input:checked + label {
            color: #f7d106;
        }
        .existing-images {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-bottom: 15px;
}

.existing-images .image-item {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.existing-images img {
    width: 170px;
    height: auto;
    object-fit: cover;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.existing-images .remove-image {
    cursor: pointer;
    color: red;
    margin-top: 5px;
    font-size: 14px;
    text-align: center;
}

    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <h2>Update Review</h2>
        <div id="success-message" class="alert-success" style="display: none;"></div>

        <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="dropzone" id="edit-review-dropzone">
            @csrf
            @method('PUT')
            <div>
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $review->first_name) }}" placeholder="First Name" required>
                <span class="text-danger">
                    @error('first_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $review->last_name) }}" placeholder="Last Name" required>
                <span class="text-danger">
                    @error('last_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $review->email) }}" placeholder="Email" required>
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div>
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $review->product_name) }}" placeholder="Product Name" required>
                <span class="text-danger">
                    @error('product_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $review->location) }}" placeholder="Location" required>
                <span class="text-danger">
                    @error('location')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $review->title) }}" placeholder="Title" required>
                <span class="text-danger">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div>
                <label for="review">Review</label>
                <textarea id="review" name="review" placeholder="Write your review" required>{{ old('review', $review->review) }}</textarea>
                <span class="text-danger">
                    @error('review')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            
            <div class="review_date">
                <label for="review_date">Review Date</label>
                <input type="date" name="review_date" id="review_date" class="form-control" value="{{ $review->review_date }}">
            </div>
            
            <div class="rating">
                <label for="star5" title="5 stars"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="star5" name="rating" value="5" {{ $review->rating == 5 ? 'checked' : '' }} />
                <label for="star4" title="4 stars"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="star4" name="rating" value="4" {{ $review->rating == 4 ? 'checked' : '' }} />
                <label for="star3" title="3 stars"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="star3" name="rating" value="3" {{ $review->rating == 3 ? 'checked' : '' }} />
                <label for="star2" title="2 stars"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="star2" name="rating" value="2" {{ $review->rating == 2 ? 'checked' : '' }} />
                <label for="star1" title="1 star"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="star1" name="rating" value="1" {{ $review->rating == 1 ? 'checked' : '' }} />
            </div>
            <div class="existing-images">
                @if(is_array($review->images) || is_object($review->images))
                    @foreach($review->images as $imagePath)
                        <div class="image-item">
                            <img src="{{ asset('storage/images/' . basename($imagePath)) }}" alt="Review Image">
                            {{-- <span class="remove-image" data-path="{{ $imagePath }}">Remove</span> --}}
                        </div>
                    @endforeach
                @else
                    <p>No images available.</p>
                @endif
            </div>
            
            <div class="dz-message">Upload your photos here</div>
            <button type="submit">Update</button>
            
        </form>
    </div>
@endsection

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script>
        
        Dropzone.options.editReviewDropzone = {
            paramName: 'images',
            acceptedFiles: '.png,.pdf,.jpeg,.jpg',
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            clickable: '.dz-message',
            init: function() {
                let myDropzone = this;
                let submitButton = document.querySelector("button[type=submit]");
                let successMessageElement = document.getElementById('success-message');
    
                submitButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
    
                    submitButton.disabled = true;
    
                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        document.getElementById('edit-review-dropzone').submit();
                    }
                });
    
                this.on("sending", function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                });
    
                this.on("queuecomplete", function() {
                    if (myDropzone.getAcceptedFiles().length === 0) {
                        document.getElementById('edit-review-dropzone').submit();
                    }
                });
    
                this.on("success", function(file, response) {
                    myDropzone.removeAllFiles();
                    document.getElementById('edit-review-dropzone').reset();
                    successMessageElement.innerHTML = 'Review submitted successfully!';
                    successMessageElement.style.display = 'block';
                });
    
                this.on("error", function(file, response) {
                    console.error(response);
                    submitButton.disabled = false;
                });
                
             
            }
        };
     </script>
     {{-- <script>
    //     document.addEventListener('DOMContentLoaded', function() {
    //         console.log('JavaScript loaded');
    //         document.querySelectorAll('.remove-image').forEach(item => {
    //             item.addEventListener('click', function() {
    //                 console.log('Button clicked');
    //                 const encodedImagePath = this.getAttribute('data-path');
    //                 const imagePath = decodeURIComponent(encodedImagePath);

    //                 console.log('Image path:', imagePath);
        
    //                 fetch('{{ route('reviews.removeImage') }}', {
    //                     method: 'DELETE',
    //                     headers: {
    //                         'Content-Type': 'application/json',
    //                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //                     },
    //                     body: JSON.stringify({ imagePath })
    //                 })
    //                 .then(response => response.json())
    //                 .then(data => {
    //                     console.log('Response data:', data);
    //                     if (data.success) {
    //                         this.parentElement.remove(); 
    //                     } else {
    //                         alert('Failed to remove image: ' + data.message);
    //                     }
    //                 })
    //                 .catch(error => {
    //                     console.error('Error removing image:', error);
    //                     alert('An error occurred while removing the image. Please try again.');
    //                 });
    //             });
    //         });
    //     });
    //     </script> --}}
@endpush
