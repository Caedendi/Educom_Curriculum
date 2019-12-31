import { Injectable } from '@angular/core';
import { User } from './user';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PeopleService {
  localApiUrl = 'http://localhost:8000/api/people';
  extApiUrl = 'http://jsonplaceholder.typicode.com/users';

  constructor(private http: HttpClient) { }

  getPeopleApi(): Observable<User[]> {
    return this.http.get<User[]>(this.extApiUrl);
  }

  getPeopleLocal(): Observable<User[]> {
    return this.http.get<User[]>(this.localApiUrl);
  }
}
