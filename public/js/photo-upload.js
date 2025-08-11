document.addEventListener('DOMContentLoaded', function() {
    // Preview Foto Utama
    function previewMainPhoto(input) {
        const mainPhotoPreview = document.getElementById('mainPhotoPreview');
        const mainPreviewImg = document.getElementById('mainPreviewImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                mainPreviewImg.src = e.target.result;
                mainPhotoPreview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Hapus Preview Foto Utama
    function removeMainPhotoPreview() {
        const mainPhotoPreview = document.getElementById('mainPhotoPreview');
        const fotoUtamaInput = document.getElementById('foto_utama');
        
        mainPhotoPreview.style.display = 'none';
        fotoUtamaInput.value = '';
    }

    // Preview Foto Tambahan
    function previewAdditionalPhotos(input) {
        const photosPreview = document.getElementById('additionalPhotosPreview');
        photosPreview.innerHTML = ''; // Clear existing previews
        
        if (input.files) {
            const files = Array.from(input.files);
            
            // Create photo grid container
            const gridContainer = document.createElement('div');
            gridContainer.className = 'photos-grid';
            
            files.forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const photoItem = document.createElement('div');
                    photoItem.className = 'photo-item';
                    photoItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="gallery-image">
                        <div class="photo-overlay">
                            <button type="button" class="remove-photo" onclick="removeAdditionalPhoto(this, ${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    gridContainer.appendChild(photoItem);
                }
                
                reader.readAsDataURL(file);
            });
            
            photosPreview.appendChild(gridContainer);
        }
    }

    // Hapus Foto Tambahan Individual
    window.removeAdditionalPhoto = function(button, index) {
        const photoItem = button.closest('.photo-item');
        const input = document.getElementById('foto');
        
        // Remove the photo item from preview
        photoItem.remove();
        
        // Remove file from input
        if (input.files) {
            const dt = new DataTransfer();
            const files = Array.from(input.files);
            
            files.forEach((file, i) => {
                if (i !== index) dt.items.add(file);
            });
            
            input.files = dt.files;
        }
    }

    // Delete Existing Photo
    window.deleteExistingPhoto = function(photoId) {
        if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            // Add hidden input for photo deletion
            const form = document.querySelector('form');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_photos[]';
            input.value = photoId;
            form.appendChild(input);
            
            // Remove photo from display
            const photoItem = document.querySelector(`.photo-item[data-photo-id="${photoId}"]`);
            if (photoItem) {
                photoItem.remove();
            }
        }
    }

    // Add Drag & Drop functionality
    const fileDropAreas = document.querySelectorAll('.glass-file-wrapper');
    
    fileDropAreas.forEach(dropArea => {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.add('drag-active');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.remove('drag-active');
            });
        });

        dropArea.addEventListener('drop', handleDrop);
    });

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const input = this.querySelector('input[type="file"]');
        
        if (input.multiple) {
            // For multiple files input
            input.files = files;
            previewAdditionalPhotos(input);
        } else {
            // For single file input
            if (files.length > 0) {
                const dt = new DataTransfer();
                dt.items.add(files[0]);
                input.files = dt.files;
                previewMainPhoto(input);
            }
        }
    }

    // Initialize file input change handlers
    const fotoUtamaInput = document.getElementById('foto_utama');
    const fotoTambahanInput = document.getElementById('foto');

    if (fotoUtamaInput) {
        fotoUtamaInput.addEventListener('change', function() {
            previewMainPhoto(this);
        });
    }

    if (fotoTambahanInput) {
        fotoTambahanInput.addEventListener('change', function() {
            previewAdditionalPhotos(this);
        });
    }
    
    // Make functions available globally
    window.previewMainPhoto = previewMainPhoto;
    window.removeMainPhotoPreview = removeMainPhotoPreview;
    window.previewAdditionalPhotos = previewAdditionalPhotos;
});

// Add CSS classes for drag & drop visual feedback
const styles = `
    .glass-file-wrapper.drag-active {
        background: var(--glass-bg-light) !important;
        border-color: rgba(102, 126, 234, 0.5) !important;
        transform: scale(1.02);
    }

    .glass-file-wrapper.drag-active .file-icon {
        transform: scale(1.2);
        color: rgba(255, 255, 255, 0.8);
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = styles;
document.head.appendChild(styleSheet);
