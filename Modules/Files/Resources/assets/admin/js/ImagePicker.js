import MediaPicker from './MediaPicker';

export default class {
    constructor() {
        $('.image-picker').on('click', (e) => {
            this.pickImage(e);
        });
        
        $('.pdf-picker').on('click', (e) => {
            this.pickPDF(e);
        });

        this.sortable();
        this.removeImageEventListener();
        
    }

    pickImage(e) {
        let inputName = e.currentTarget.dataset.inputName;
        let multiple = e.currentTarget.hasAttribute('data-multiple');

        let picker = new MediaPicker({ type: 'image', multiple });

        picker.on('select', (file) => {
            this.addImage(inputName, file, multiple, e.currentTarget);
        });
    }
    
    pickPDF(e) {
        let inputName = e.currentTarget.dataset.inputName;
        let multiple = e.currentTarget.hasAttribute('data-multiple');
        
        let allowExtension= 'pdf';
        if(e.currentTarget.hasAttribute('data-filetype')){
            allowExtension  =e.currentTarget.dataset.filetype;
        }
        let picker = new MediaPicker({ type: '',extension: allowExtension, multiple });

        picker.on('select', (file) => {
            this.addPDF(inputName, file, multiple, e.currentTarget);
        });
    }    

    addImage(inputName, file, multiple, target) {
        let html = this.getTemplate(inputName, file);

        if (multiple) {
            let multipleImagesWrapper = $(target).next('.multiple-images');

            multipleImagesWrapper.find('.image-holder.placeholder').remove();
            multipleImagesWrapper.find('.image-list').append(html);
        } else {
            $(target).siblings('.single-image').html(html);
            $('.image-file-name').val(file.filename);
        }
    }
    
    addPDF(inputName, file, multiple, target) {
        let html = this.getPDFTemplate(inputName, file);
        
        if (multiple) {
            let multipleImagesWrapper = $(target).next('.multiple-images');

            multipleImagesWrapper.find('.image-holder.placeholder').remove();
            multipleImagesWrapper.find('.image-list').append(html);
            let valid=multipleImagesWrapper.attr('data-input-validation');
            if(valid!=''){
                $("."+valid).val('1');
            }
        } else {
            $(target).siblings('.single-image').html(html);
            $('.pdf-file-name').val(file.filename);
        }
    }

    getTemplate(inputName, file) {
        return $(`
            <div class="image-holder">
                <img src="${file.path}">
                <button type="button" class="btn remove-image"></button>
                <input type="hidden" name="${inputName}" value="${file.id}">
            </div>
        `);
    }
    
    getPDFTemplate(inputName, file) {
        return $(`
            <div class="image-holder">
                <i class="fas fa-file"></i>
                <button type="button" class="btn remove-pdf"></button>
                <input type="hidden" name="${inputName}" value="${file.id}">
                <textarea class="form-control file-display-name" readonly="1">${file.filename}</textarea>
            </div>
        `);
    }

    sortable() {
        let imageList = $('.image-list');

        if (imageList.length > 0) {
            Sortable.create(imageList[0], { animation: 150 });
        }
    }

    removeImageEventListener() {
        $('.image-holder-wrapper').on('click', '.remove-image', (e) => {
            e.preventDefault();

            console.log(e.currentTarget.dataset);
            let imageHolderWrapper = $(e.currentTarget).closest('.image-holder-wrapper');

            if (imageHolderWrapper.find('.image-holder').length === 1) {
                imageHolderWrapper.html(
                    this.getImagePlaceholder(e.currentTarget.dataset.inputName)
                );
            }
            $('.image-file-name').val('');
            $(e.currentTarget).parent().remove();
        });
        
        $('.image-holder-wrapper').on('click', '.remove-pdf', (e) => {
            e.preventDefault();

            console.log(e.currentTarget.dataset);
            let imageHolderWrapper = $(e.currentTarget).closest('.image-holder-wrapper');

            if (imageHolderWrapper.find('.image-holder').length === 1) {
                imageHolderWrapper.html(
                    this.getPDFPlaceholder(e.currentTarget.dataset.inputName)
                );
                if(e.currentTarget.dataset.inputValidation!=''){
                    let valid=e.currentTarget.dataset.inputValidation;
                    $('.'+valid).val('');
                }
            }
            if(!imageHolderWrapper.hasClass('notRequired')){
                $('.pdf-file-name').val('');
            }

            $(e.currentTarget).parent().remove();
        });
    }
    
    getImagePlaceholder(inputName) {
        return `
            <div class="image-holder placeholder cursor-auto">
                <i class="fas fa-camera-retro"></i>
                <input type="hidden" name="${inputName}">
            </div>
        `;
    }
    
    getPDFPlaceholder(inputName) {
        return `
            <div class="image-holder placeholder cursor-auto">
                <i class="fas fa-upload"></i>
                <input type="hidden" name="${inputName}">
            </div>
        `;
    } 
}
