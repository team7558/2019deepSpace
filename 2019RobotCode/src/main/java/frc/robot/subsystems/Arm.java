/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.Subsystem;

import java.util.HashMap;
import java.util.Map;
/**
 * Add your docs here.
 */
public class Arm extends Subsystem {

  private PIDMotorJoint m_elbow, m_wrist;
  private double m_jointHeight;

  private Map<String, double[]> m_presets;

  public Arm(double jointHeight, Elbow elbow, Wrist wrist){
    m_elbow = elbow;
    m_wrist = wrist;
    m_jointHeight = jointHeight;

    m_presets = new HashMap<String, double[]>();

    m_presets.put("INTAKE_CARGO", new double[]{0,0});
    m_presets.put("INTAKE_HATCH_GROUND", new double[]{0,0});
    m_presets.put("INTAKE_HATCH_HUMAN", new double[]{0,0});
    m_presets.put("SHOOT_CARGO_SHIP", new double[]{0,0});
    m_presets.put("SHOOT_CARGO_ROCKET_1", new double[]{0,0});
  
  }

  public void zero(){
    m_elbow.resetAngle();
    m_wrist.resetAngle();
  }

  public void goToPreset(String presetName){
    setAngle(m_presets.get(presetName));
  }

  public void setAngle(double[] angles){
    m_elbow.setAngle(angles[0]);
    Thread moveArm = new Thread(() -> {
      while(!Thread.interrupted()){
        if (m_jointHeight + m_elbow.getHeight() + m_wrist.getHeight() > 5){
          m_wrist.setAngle(angles[1]);
        } else {
          m_wrist.hold();
        }
        if (Math.abs(angles[0] - getAngles()[0]) < 5 && Math.abs(angles[1] - getAngles()[1]) < 5){
          Thread.currentThread().interrupt();
        }
      }
    });
    moveArm.start();
  }

  public double[] getAngles(){
    return new double[]{m_elbow.getAngle(), m_wrist.getAngle() + m_elbow.getAngle()};
  }

  public void enable(){
    m_elbow.enable();
    m_wrist.enable();
  }

  public void disable(){
    m_elbow.disable();
    m_wrist.disable();
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }
}
