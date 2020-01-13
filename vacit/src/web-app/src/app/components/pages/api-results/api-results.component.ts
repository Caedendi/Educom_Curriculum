import { Component, OnInit } from '@angular/core';
import { User } from '../../../user';
import { UserService } from '../../../user.service';
import { PeopleService } from '../../../people.service';

@Component({
  selector: 'app-api-results',
  templateUrl: './api-results.component.html',
  styleUrls: ['./api-results.component.scss']
})
export class ApiResultsComponent implements OnInit {
  users: User[];
  peopleLocal$: User[];

  constructor(
    private userService: UserService,
    private peopleService: PeopleService
  ) { }

  ngOnInit() {
    this.getUsers();
    this.getPeople();
  }

  getUsers(): void {
    this.users = this.userService.getUsers();
  }

  getPeople(): void {
    this.peopleService.getPeopleLocal()
      .subscribe(data => this.peopleLocal$ = data);
  }

}
