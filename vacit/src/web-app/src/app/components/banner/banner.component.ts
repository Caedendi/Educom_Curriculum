import { Component, OnInit } from '@angular/core';

declare var $: any;

@Component({
  selector: 'app-banner',
  templateUrl: './banner.component.html',
  styleUrls: ['./banner.component.scss']
})
export class BannerComponent implements OnInit {

  constructor() {
  }

  ngOnInit() {
    this.doSlideShow();
  }

  doSlideShow(): void {
    $('#homepage-banner').vegas({
      overlay: true,
      transition: 'fade',
      transitionDuration: 4000,
      delay: 10000,
      animation: 'random',
      animationDuration: 20000,
      slides: [
        {src: 'https://cdn.pling.com/img/8/5/c/a/e360705a5087cf5d30d7f8fafc6736673bf7.jpg'},
        {src: 'https://cdn.pling.com/img/7/e/c/6/6a96f2c5aeb0f166183eb70910c6aefe5351.jpg'},
        {src: 'https://wallpaperaccess.com/full/305484.jpg'},
        {src: 'https://cdn.pling.com/img/f/a/5/a/aaefb305e9f7cf2ee834727371b1c31cedaf.jpg'},
      ]
    });
  }

}
