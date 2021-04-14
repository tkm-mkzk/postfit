import './bootstrap'
import Vue from 'vue'
import BlogLike from './components/BlogLike'
import BlogTagsInput from './components/BlogTagsInput'
import FollowButton from './components/FollowButton'

const app = new Vue({
  el: '#app',
  components: {
    BlogLike,
    BlogTagsInput,
    FollowButton,
  }
})

document.querySelector('.image-picker input')
    .addEventListener('change', (e) => {
        const input = e.target;
        const reader = new FileReader();
        if (!input){ return false;}
        reader.onload = (e) => {
            input.closest('.image-picker').querySelector('img').src = e.target.result
        };
        reader.readAsDataURL(input.files[0]);
    });
