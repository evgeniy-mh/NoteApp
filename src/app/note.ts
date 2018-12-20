export class Note {
  idNote: number;
  idUser: number;
  noteName: string;
  noteContent: string;
  noteDate: Date;

  constructor() {
    this.idUser = 0;
    this.noteName = '';
    this.noteContent = '';
    //this.noteDate = new Date(Date.now());
  }
}
