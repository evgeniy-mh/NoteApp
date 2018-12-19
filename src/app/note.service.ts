import {Injectable} from '@angular/core';
import {Observable, of, throwError} from 'rxjs';
import {HttpClient, HttpErrorResponse, HttpParams} from '@angular/common/http';

import {map, catchError} from 'rxjs/operators';
import {Note} from './note';
import {Notes} from './mock-notes';

@Injectable({providedIn: 'root'})
export class NoteService {
  constructor(private http: HttpClient) {}

  //getNotes(): Observable<Note[]> { return of(Notes); }

  getNotes(): Observable<Note[]> {
    return this.http.get<Note[]>('/api/NotesJSONloc.php');
  }
}
