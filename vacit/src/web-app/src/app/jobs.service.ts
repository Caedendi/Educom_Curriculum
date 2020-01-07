import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Job } from './job';

@Injectable({
  providedIn: 'root'
})
export class JobsService {
  private apiUrl = 'http://localhost:8000/api/recents';

  constructor(private http: HttpClient) { }

  getRecents(): Observable<Job[]> {
    return this.http.get<Job[]>(this.apiUrl);
  }
}
