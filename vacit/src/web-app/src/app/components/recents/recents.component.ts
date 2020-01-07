import { Component, OnInit } from '@angular/core';
import { Job } from '../../job';
import { JobsService } from '../../jobs.service';

@Component({
  selector: 'app-recents',
  templateUrl: './recents.component.html',
  styleUrls: ['./recents.component.scss']
})
export class RecentsComponent implements OnInit {
  recents$: Job[];

  constructor(private jobsService: JobsService) {
  }

  ngOnInit() {
    this.getRecents();
  }

  getRecents(): void {
    this.jobsService.getRecents()
      .subscribe(data => this.recents$ = data);
  }

}
