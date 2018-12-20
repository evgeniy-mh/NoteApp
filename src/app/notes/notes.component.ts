import {Component, OnInit} from '@angular/core';
import {NoteService} from '../note.service';
import {Note} from '../note';

@Component({
  selector: 'app-notes',
  templateUrl: './notes.component.html',
  styleUrls: ['./notes.component.css']
})
export class NotesComponent implements OnInit {
  notes: Note[];

  note: Note = new Note();

  constructor(private noteService: NoteService) {}

  ngOnInit() { this.getNotes(); }

  addNote(): void {
    this.note.noteDate = new Date(Date.now());
    console.log(this.note);
    this.noteService.addNote(this.note).subscribe(newNoteId => {
      this.note.idNote = newNoteId;
      console.log(this.note);
      this.notes.push(this.note);
      this.note = new Note();
    });
  }

  getNotes(): void {
    this.noteService.getNotes().subscribe(notes => { this.notes = notes; });
  }

  deleteNoteRequest(id): void { console.log(id); }
}
