import { Injectable } from '@angular/core';
import { User } from './user';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  users: User[] = [
    { id: 11, name: 'Dr Nice', username: 'hoi', email: 'example2@doei.nl' },
    { id: 12, name: 'Narco', username: 'hoi', email: 'example2@doei.nl' },
    { id: 13, name: 'Bombasto', username: 'hoi', email: 'example2@doei.nl' },
  ];

  constructor() { }

  getUsers(): User[] {
    return this.users;
  }
}
