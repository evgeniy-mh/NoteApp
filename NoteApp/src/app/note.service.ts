import {Injectable} from '@angular/core';
import {Observable, of, throwError} from 'rxjs';
import {
  HttpClient,
  HttpErrorResponse,
  HttpParams,
  HttpHeaders
} from '@angular/common/http';

import {map, catchError} from 'rxjs/operators';
import {Note} from './note';

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json'  //,
    //'Authorization': 'my-auth-token'
  })
};

@Injectable({providedIn: 'root'})
export class NoteService {
  notesApi = '/api_local';
  //notesApi = '/api';

  constructor(private http: HttpClient) {}

  // getNotes(): Observable<Note[]> { return of(Notes); }

  getNotes(): Observable<Note[]> {
    return this.http.get<Note[]>(this.notesApi + '/get_notes.php');
  }

  addNote(note: Note): Observable<number> {
    return this.http
        .post<number>(this.notesApi + '/add_note.php', note, httpOptions)
        .pipe(catchError(this.handleError));
  }

  deleteNote(noteId: number): Observable<{}> {
    const url = `${this.notesApi}/del_note.php?id=${noteId}`;
    // return this.http.delete(url, httpOptions)
    //     .pipe(catchError(this.handleError));

    // infinity free server does not support DELETE API
    return this.http.get(url);
  }

  private handleError(error: HttpErrorResponse) {
    if (error.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      console.error('An error occurred:', error.error.message);
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      console.error(
          `Backend returned code ${error.status}, ` +
          `body was: ${error.error}`);
    }
    // return an observable with a user-facing error message
    return throwError('Something bad happened; please try again later.');
  }
}
