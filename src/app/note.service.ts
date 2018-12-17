import {Injectable} from '@angular/core';
import {Observable, of} from 'rxjs';
import {Note} from './note';
import {Notes} from './mock-notes';

@Injectable({providedIn: 'root'})
export class NoteService {
  constructor() {}

  // getNotes(): Note[] {
  //   return Notes;
  // }

  getNotes(): Observable<Note[]> { return of(Notes); }
}
