//
//  Cours.swift
//  AppliCours
//
//  Created by andre jeremy on 30/01/2019.
//  Copyright © 2019 ramousset vincent. All rights reserved.
//

import Foundation

struct Cours: Codable {
    var mailEleve: String
    var mailProf: String
    var idMat: Int
    var matiere: String
    var idNiveau: Int
    var niveau: String
    var dateCours: Date
    var etat: String
    
    enum CodingKeys: String, CodingKey {
        case mailEleve
        case mailProf
        case idMat
        case matiere
        case idNiveau
        case niveau
        case dateCours
        case etat
    }
    
    init(from decoder: Decoder) throws {
        let valueContainer = try decoder.container(keyedBy: CodingKeys.self)
        
        self.mailEleve = try valueContainer.decode(String.self, forKey: CodingKeys.mailEleve)
        self.mailProf = try valueContainer.decode(String.self, forKey: CodingKeys.mailProf)
        self.idMat = try valueContainer.decode(Int.self, forKey: CodingKeys.idMat)
        self.matiere = try valueContainer.decode(String.self, forKey: CodingKeys.matiere)
        self.idNiveau = try valueContainer.decode(Int.self, forKey: CodingKeys.idNiveau)
        self.niveau = try valueContainer.decode(String.self, forKey: CodingKeys.niveau)
        self.dateCours = try valueContainer.decode(Date.self, forKey: CodingKeys.dateCours)
        self.etat = try valueContainer.decode(String.self, forKey: CodingKeys.etat)
    }
}
