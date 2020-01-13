import { Injectable } from '@angular/core';
import { User } from './user';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PeopleService {
  localApiUrl = 'http://localhost:8000/api/people';

  constructor(private http: HttpClient) { }

  getPeopleLocal(): Observable<User[]> {
    return this.http.get<User[]>(this.localApiUrl);
  }
}
