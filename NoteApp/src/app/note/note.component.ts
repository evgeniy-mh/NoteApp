import {Component, OnInit, Input, Output, EventEmitter} from '@angular/core';
import {Note} from '../note';

@Component({
  selector: 'app-note',
  templateUrl: './note.component.html',
  styleUrls: ['./note.component.css']
})
export class NoteComponent implements OnInit {
  @Input() note: Note;
  @Output() deleteRequest = new EventEmitter<number>();

  public isCollapsed = true;

  constructor() {}

  ngOnInit() {}

  deleteNote(): void { this.deleteRequest.emit(this.note.idNote); }
}
