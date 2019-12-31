import { Component, OnInit } from '@angular/core';
import { User } from '../user';
import { UserService } from '../user.service';
import { PeopleService } from '../people.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
  users: User[];
  peopleApi$: User[];
  peopleLocal$: User[];

  constructor(
    private userService: UserService,
    private peopleService: PeopleService,
  ) { }

  ngOnInit() {
    this.getUsers();
    this.getPeople();
  }

  getUsers(): void {
    this.users = this.userService.getUsers();
  }

  getPeople(): void {
    this.peopleService.getPeopleApi()
      .subscribe(data => this.peopleApi$ = data);

    this.peopleService.getPeopleLocal()
      .subscribe(data => this.peopleLocal$ = data);
  }
}
